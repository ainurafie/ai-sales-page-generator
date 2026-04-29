<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSalesPageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_name' => 'required|string|max:255',
            'description' => 'required|string',
            'features' => 'required|string',
            'target_audience' => 'required|string|max:255',
            'price' => 'nullable|string|max:255',
            'usp' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'product_name.required' => 'Nama produk wajib diisi.',
            'description.required' => 'Deskripsi wajib diisi.',
            'features.required' => 'Fitur utama wajib diisi.',
            'target_audience.required' => 'Target audience wajib diisi.',
        ];
    }
}
