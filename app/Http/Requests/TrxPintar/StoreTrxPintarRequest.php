<?php

namespace App\Http\Requests\TrxPintar;

use Illuminate\Foundation\Http\FormRequest;

class StoreTrxPintarRequest extends FormRequest
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
            'pelanggan_id' => ['nullable', 'exists:m_pelanggan,id'],
            'metode_bayar_id' => ['required', 'exists:m_metode_bayar,id'],
            'total' => ['required', 'numeric'],
            'total_bayar' => ['required', 'numeric'],

            'details' => ['required', 'array'],
            'details.*.produk_id' => ['required', 'in:m_produk,id'],
            'details.*.kuantitas' => ['required', 'numeric'],
            'details.*.total' => ['required', 'numeric']
        ];
    }
}
