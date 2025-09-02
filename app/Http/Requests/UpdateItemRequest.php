<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule; // Import Rule

class UpdateItemRequest extends FormRequest
{
    /**
     * Tentukan apakah pengguna berwenang untuk membuat permintaan ini.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Dapatkan aturan validasi yang berlaku untuk permintaan.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            // Aturan 'unique' diubah untuk mengabaikan item yang sedang diedit
            'kode_barang' => [
                'required',
                'string',
                'max:255',
                Rule::unique('items')->ignore($this->item),
            ],
            'nama_barang' => 'required|string|max:255',
            'jumlah'      => 'required|integer|min:0',
            'harga'       => 'required|numeric|min:0',
        ];
    }
}