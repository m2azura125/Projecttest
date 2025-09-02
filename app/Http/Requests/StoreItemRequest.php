<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemRequest extends FormRequest
{
    /**
     * Tentukan apakah pengguna berwenang untuk membuat permintaan ini.
     */
    public function authorize(): bool
    {
        // Ubah menjadi true agar semua pengguna bisa membuat item.
        // Anda bisa menambahkan logika otorisasi di sini jika perlu.
        return true;
    }

    /**
     * Dapatkan aturan validasi yang berlaku untuk permintaan.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        // Pindahkan aturan validasi dari controller ke sini
        return [
            'kode_barang' => 'required|string|unique:items,kode_barang|max:255',
            'nama_barang' => 'required|string|max:255',
            'jumlah'      => 'required|integer|min:0',
            'harga'       => 'required|numeric|min:0',
        ];
    }
}