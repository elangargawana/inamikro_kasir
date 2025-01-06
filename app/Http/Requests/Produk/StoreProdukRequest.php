<?php

namespace App\Http\Requests\Produk;

use Illuminate\Foundation\Http\FormRequest;

class StoreProdukRequest extends FormRequest
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
            'kategori_produk_id' => ['required', 'exists:m_kategori_produk,id'],
            'code' => ['required', 'string'],
            'nama_produk' => ['required', 'string'],
            'satuan_id' => ['required', 'exists:m_satuan,id'],
            'stok' => ['required', 'numeric'],
            'harga_jual' => ['required', 'numeric'],
            'harga_modal' => ['required', 'numeric'],
            'kadaluwarsa' => ['nullable', 'date']
        ];
    }
}
