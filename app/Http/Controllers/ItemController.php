<?php

namespace App\Http\Controllers;


use App\Models\Item;
use App\Http\Requests\StoreItemRequest; // Diimpor
use App\Http\Requests\UpdateItemRequest; // Diimpor
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    /**
     * Menampilkan daftar semua item dengan paginasi.
     */
    public function index()
    {
        $items = Item::latest()->paginate(10);
        return view('items.index', compact('items'));
    }
    public function summary()
    {
        // Ambil semua data dari database view 'item_summaries'
        $summaries = DB::table('item_summaries')->paginate(10);

        // Kirim data ke view baru
        return view('items.summary', compact('summaries'));
    }

    /**
     * Menampilkan formulir untuk membuat item baru.
     */
    public function create()
    {
        return view('items.create');
    }

    /**
     * Menyimpan item baru ke dalam database.
     * Validasi ditangani oleh StoreItemRequest.
     */
    public function store(StoreItemRequest $request)
    {
        // Data yang masuk sudah pasti valid
        Item::create($request->validated());

        return redirect()->route('items.index')
                         ->with('success', 'Item berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail satu item.
     */
    public function show(Item $item)
    {
        return view('items.show', compact('item'));
    }

    /**
     * Menampilkan formulir untuk mengedit item.
     */
    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    /**
     * Memperbarui item yang ada di database.
     * Validasi ditangani oleh UpdateItemRequest.
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        // Data yang masuk sudah pasti valid
        $item->update($request->validated());

        return redirect()->route('items.index')
                         ->with('success', 'Item berhasil diperbarui.');
    }

    /**
     * Menghapus item dari database.
     */
    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('items.index')
                         ->with('success', 'Item berhasil dihapus.');
    }
    /**
     * Menghapus beberapa item yang dipilih.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function bulkDestroy(Request $request)
    {
        // Validasi jika tidak ada item yang dipilih
        $request->validate([
            'selected_items' => 'required|array',
        ]);

        $selectedIds = $request->input('selected_items');

        // Hapus item berdasarkan ID yang dipilih
        Item::whereIn('id', $selectedIds)->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('items.index')
                         ->with('success', 'Item yang dipilih berhasil dihapus.');
    }
}