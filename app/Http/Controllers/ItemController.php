<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::latest()->paginate(10); // Ambil data terbaru dengan paginasi
        return view('items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('items.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'kode_barang' => 'required|string|unique:items|max:255',
            'nama_barang' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
        ]);

        Item::create($request->all());

        return redirect()->route('items.index')
                         ->with('success', 'Item berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        return view('items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        // Validasi input
        $request->validate([
            'kode_barang' => 'required|string|max:255|unique:items,kode_barang,'.$item->id,
            'nama_barang' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
        ]);

        $item->update($request->all());

        return redirect()->route('items.index')
                         ->with('success', 'Item berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('items.index')
                         ->with('success', 'Item berhasil dihapus.');
    }
}
