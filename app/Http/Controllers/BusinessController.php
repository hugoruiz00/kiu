<?php

namespace App\Http\Controllers;

use App\Http\Requests\BusinessSaveRequest;
use App\Models\Business;
use App\Models\BusinessCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class BusinessController extends Controller
{
    public function index(Request $request){
        $search = $request->input('search');

        if(empty($search)){
            $businesses = [];
            return view('welcome', compact('businesses', 'search'));
        }

        $businesses = Business::select('id', 'name', 'image', 'is_open', 'business_category_id')
            ->with(['business_category'])
            ->when($search, function (Builder $query, string $search) {
                $query->where('name', 'LIKE', "%$search%");                
            })
            ->paginate();

        return view('welcome', compact('businesses', 'search'));
    }

    public function edit(Request $request)
    {
        $business_categories = BusinessCategory::all();
        $business = $request->user()->business;
        return view('business.edit', compact('business_categories', 'business'));
    }

    public function save(BusinessSaveRequest $request){
        try {
            $data = $request->validated();
            
            $existing_business = $request->user()->business;
            $image_path = $this->store_image($request, $existing_business);

            $business_id = $existing_business->id ?? null;
            $saved_business = Business::updateOrCreate(
                ['id' => $business_id],
                [
                    'image' => $image_path,
                    'name' => $data['name'],
                    'phone_number' => $data['phone_number'],
                    'estimated_service_time' => $data['estimated_service_time'],
                    'business_category_id' => $data['business_category_id'],
                    'user_id' => $request->user()->id,
                ]
            );

            return redirect()->route('business.edit')->with([
                'status' => 'success',
                'message' => 'Información guardada correctamente'
            ]);
        } catch (\Throwable $th) {
            return redirect()->route('business.edit')->with([
                'status' => 'danger',
                'message' => 'No se pudo guardar la información, verifique los datos'
            ]);
        }
    }

    private function store_image($request, $existing_business){
        $path = $existing_business->image ?? null;
        $file = $request->file('image');
        if(!empty($file)){
            if(!empty($existing_business->image) && Storage::disk('public')->exists($existing_business->image)){
                // Remove old image if exists
                Storage::disk('public')->delete($existing_business->image);
            }
            $path = $file->store('businessprofiles', 'public');
        }

        return $path;
    }

    public function manage($business_id){
        $business = Business::find($business_id);

        $qr_code = QrCode::size(150)->generate(route('business.public_active_clients', $business));

        return view('business.manage', compact('business', 'qr_code'));
    }

    public function toggle_status(Business $business){
        $business->update(['is_open' => !$business->is_open]);

        return redirect()->route('business.manage', $business);
    }
}
