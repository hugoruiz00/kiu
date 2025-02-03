<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BusinessSaveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:250',
            'business_category_id' => 'required|exists:business_categories,id',
            'estimated_service_time' => 'required|numeric|integer',
            'phone_number' => 'nullable|numeric|integer|min_digits:7|max_digits:15',
            'image' => 'mimes:jpg,png|max:2048'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nombre',
            'business_category_id' => 'tipo de negocio',
            'estimated_service_time' => 'tiempo estimado',
            'phone_number' => 'teléfono',
            'image' => 'imagen'
        ];
    }
}
