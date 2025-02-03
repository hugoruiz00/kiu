<?php

namespace App\Http\Controllers;

use App\Enums\QueueStatusEnum;
use App\Events\QueueUpdated;
use App\Http\Requests\AddQueueEntryRequest;
use App\Http\Requests\DeleteQueueEntryRequest;
use App\Http\Requests\ViewQueueEntryRequest;
use App\Models\Business;
use App\Models\QueueClient;
use App\Models\QueueEntry;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BusinessQueueController extends Controller
{
    public function active_clients($business_id)
    {
        $business = Business::find($business_id);
        $queue_entries = $business->queue_entries()
                                    ->where(['status' => QueueStatusEnum::ACTIVE])
                                    ->with('queue_client')->get();
        
        return view('business.active-clients', compact('queue_entries', 'business'));
    }

    public function add_queue_entry(AddQueueEntryRequest $request, Business $business)
    {
        try {
            $data = $request->validated();
            $queue_entry = $this->save_queue_entry($data, $business);
            
            return redirect()->route('business.active_clients', $business)->with([
                'code-queue-entry' => $queue_entry->code
            ]);
        } catch (\Throwable $th) {
            return redirect()->route('business.active_clients', $business)->with([
                'status' => 'danger',
                'message' => 'No se pudo guardar la información, intente nuevamente'
            ]);
        }
    }

    public function attend_queue_entry(QueueEntry $queue_entry)
    {
        $business = $queue_entry->business;
        try{
            $queue_entry->update(['status' => QueueStatusEnum::ATTENDED]);

            $this->send_updated_queue_event($business);

            return redirect()->route('business.active_clients', $business)->with([
                'status' => 'success',
                'message' => 'Cliente atendido'
            ]);
        } catch (\Throwable $th) {
            return redirect()->route('business.active_clients', $business)->with([
                'status' => 'danger',
                'message' => 'No se pudo marcar como atendido, intente nuevamente'
            ]);
        }
    }

    public function public_active_clients(Business $business)
    {
        $queue_entries = $business->queue_entries()
                                    ->select('id', 'queue_client_id')
                                    ->where(['status' => QueueStatusEnum::ACTIVE])
                                    ->with('queue_client')->get() ?? [];
        
        return view('business.public-active-clients', compact('queue_entries', 'business'));
    }

    public function public_add_queue_entry(AddQueueEntryRequest $request, Business $business)
    {
        try{
            if(!$business->is_open) {
                return redirect()->route('business.public_active_clients', $business)->with([
                    'status' => 'warning',
                    'message' => 'El negocio está cerrado, podrás registrarte cuando vuelva a abrir'
                ]);
            }

            $data = $request->validated();
            $queue_entry = $this->save_queue_entry($data, $business);
            
            return redirect()->route('business.view_queue_entry', [
                'queue_entry' => $queue_entry->id,
                'code' => $queue_entry->code,
            ]);
        } catch (\Throwable $th) {
            return redirect()->route('business.public_active_clients', $business)->with([
                'status' => 'danger',
                'message' => 'No se pudo guardar la información, intente nuevamente'
            ]);
        }
    }

    private function save_queue_entry($data, $business){
        $code = $this->generate_queue_code();

        $client = QueueClient::create(['name' => $data['name']]);
        $queue_entry = QueueEntry::create([
            'position' => Carbon::now(),
            'code' => $code,
            'estimated_service_time' => $business->estimated_service_time,
            'status' => QueueStatusEnum::ACTIVE,
            'business_id' => $business->id,
            'queue_client_id' => $client->id,
        ]);

        $this->send_updated_queue_event($business);

        return $queue_entry;
    }

    private function generate_queue_code(){
        $letter = chr(rand(65, 90)); // ASCII for A-Z (65-90)
        $number = rand(0, 9);
        return $letter . $number;
    }

    private function send_updated_queue_event($business) {
        $queue_entries = $business->queue_entries()
                                ->select('id', 'position', 'business_id', 'queue_client_id')
                                ->where(['status' => QueueStatusEnum::ACTIVE])
                                ->with('queue_client')
                                ->get()
                                ->map(function ($entry) {
                                    return [
                                        'id' => $entry->id,
                                        'position_number' => $entry->position_number,
                                        'queue_client' => [
                                            'name' => $entry->queue_client->name
                                        ]
                                    ];
                                });

        QueueUpdated::dispatch($business->id, $queue_entries);
    }

    public function view_queue_entry(ViewQueueEntryRequest $request, QueueEntry $queue_entry)
    {
        if(QueueStatusEnum::tryFrom($queue_entry->status) !== QueueStatusEnum::ACTIVE) {
            $message_info = match (QueueStatusEnum::tryFrom($queue_entry->status)) {
                QueueStatusEnum::ATTENDED => 'Ya has sido atendido',
                QueueStatusEnum::CANCELED => 'El turno ha sido cancelado',
            };

            return redirect()->route('business.public_active_clients', $queue_entry->business)->with([
                'status' => 'warning',
                'message' => $message_info
            ]); 
        }

        $data = $request->validated();

        return view('business.view-queue-entry', compact('queue_entry'));
    }

    public function cancel_queue_entry(DeleteQueueEntryRequest $request, QueueEntry $queue_entry)
    {
        if(QueueStatusEnum::tryFrom($queue_entry->status) !== QueueStatusEnum::ACTIVE) {
            $message_info = match (QueueStatusEnum::tryFrom($queue_entry->status)) {
                QueueStatusEnum::ATTENDED => 'Ya has sido atendido',
                QueueStatusEnum::CANCELED => 'El turno ha sido cancelado',
            };

            return redirect()->route('business.public_active_clients', $queue_entry->business)->with([
                'status' => 'warning',
                'message' => $message_info
            ]); 
        }

        $business = $queue_entry->business;
        $queue_entry->update(['status' => QueueStatusEnum::CANCELED]);

        $this->send_updated_queue_event($business);

        return redirect()->route('business.public_active_clients', $business);
    }
}
