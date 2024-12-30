<?php

namespace App\Http\Requests\TrxCepat;

use Illuminate\Foundation\Http\FormRequest;

class StoreTrxCepatRequest extends FormRequest
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
            'details.*.nama_produk' => ['required', 'string'],
            'details.*.harga_satuan' => ['required', 'numeric'],
            'details.*.kuantitas' => ['required', 'numeric'],
            'details.*.satuan_id' => ['required', 'exists:m_satuan,id'],
            'details.*.total' => ['required', 'numeric']
        ];
    }
}
