<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentSaveRequest extends FormRequest
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
            'content' => 'required|string|min:10|max:5000',
            'email' => 'nullable|string|email',
            'phone_number' => 'nullable|numeric|integer|min_digits:7|max_digits:15',
        ];
    }

    public function attributes()
    {
        return [
            'content' => 'comentario',
            'email' => 'correo',
            'phone_number' => 'teléfono',
        ]; 
    }
}
