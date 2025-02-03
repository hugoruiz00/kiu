<?php

namespace App\Http\Requests;

use App\Models\QueueEntry;
use Closure;
use Illuminate\Foundation\Http\FormRequest;

class ViewQueueEntryRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;
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
            'code' => [
                'bail',
                'required',
                'string',
                'size:2',
                function (string $attribute, mixed $value, Closure $fail) {
                    $queue_entry = $this->route('queue_entry');
                    if($queue_entry?->code !== $value){
                        $fail("El código no es válido.");
                    }
                }
            ],
        ];
    }

    public function attributes()
    {
        return [
            'code' => 'código',
        ];
    }
}
