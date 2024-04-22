<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemEditRequest extends FormRequest
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
            'name' => ['required','max:255'],
            'description' => ['required', 'max:1000'],
            'price' => ['required', 'integer', 'min:1', 'max:1000000'],
            'category_id' => ['required', 'exists:categories,id'],
        ];
    }
}
