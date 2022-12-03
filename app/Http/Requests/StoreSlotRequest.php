<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSlotRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // todo creating only by admin
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'from' => 'required|date',
            'to' => 'required|date',
            'info.name' => 'required',
            'info.description' => 'required',
            'info.price' => 'numeric',
            'info.capacity' => 'numeric',
        ];
    }
}
