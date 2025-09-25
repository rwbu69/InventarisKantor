<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventories = Inventory::latest()->paginate(10);
        return view('inventories.index', compact('inventories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('inventories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|max:255',
            'kategori' => 'required|max:255',
            'jumlah' => 'required|integer|min:0',
            'satuan' => 'required|max:255',
            'harga' => 'nullable|numeric|min:0',
            'lokasi' => 'required|max:255',
            'tanggal_masuk' => 'required|date',
            'kondisi' => 'required|max:255',
            'kode_barang' => 'required|unique:inventories,kode_barang|max:255'
        ]);

        Inventory::create($request->all());

        return redirect()->route('inventories.index')
            ->with('success', 'Barang berhasil ditambahkan ke inventaris.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventory $inventory)
    {
        return view('inventories.show', compact('inventory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventory $inventory)
    {
        return view('inventories.edit', compact('inventory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inventory $inventory)
    {
        $request->validate([
            'nama_barang' => 'required|max:255',
            'kategori' => 'required|max:255',
            'jumlah' => 'required|integer|min:0',
            'satuan' => 'required|max:255',
            'harga' => 'nullable|numeric|min:0',
            'lokasi' => 'required|max:255',
            'tanggal_masuk' => 'required|date',
            'kondisi' => 'required|max:255',
            'kode_barang' => 'required|max:255|unique:inventories,kode_barang,' . $inventory->id
        ]);

        $inventory->update($request->all());

        return redirect()->route('inventories.index')
            ->with('success', 'Data barang berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventory $inventory)
    {
        $inventory->delete();

        return redirect()->route('inventories.index')
            ->with('success', 'Barang berhasil dihapus dari inventaris.');
    }
}
