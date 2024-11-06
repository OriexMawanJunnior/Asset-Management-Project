<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asset;

class AssetController  
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Asset::all();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'merk' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:50',
            'serial_number' => 'nullable|string|max:100',
            'purchase_order_number' => 'nullable|string|max:100',
            'purchase_price' => 'nullable|numeric',
            'quantity' => 'required|integer',
            'condition' => 'required|string|max:50',
            'status' => 'required|string|max:50',
            'remaks' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'asset_detail_url' => 'nullable|url',
            'qr_code_path' => 'nullable|string|max:255',
            'date_of_receipt' => 'required|date',
            'category_id' => 'required|integer|exists:category,id',
            'subcategory_id' => 'required|integer|exists:subcategory,id',
            'number' => 'nullable|integer'
        ]);

        // Buat asset baru dengan data yang valid
        $asset = Asset::create($validatedData);

        // Berikan response sukses
        return response()->json($asset, 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         // Mengambil asset berdasarkan ID
         $asset = Asset::find($id);

         // Memeriksa apakah asset ditemukan
         if (!$asset) {
             return response()->json(['message' => 'Asset not found'], 404);
         }
 
         // Mengembalikan asset dalam format JSON
         return response()->json($asset);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Mengambil asset berdasarkan ID
        $asset = Asset::find($id);

        // Memeriksa apakah asset ditemukan
        if (!$asset) {
            return response()->json(['message' => 'Asset not found'], 404);
        }

        // Validasi data yang diterima
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'merk' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:50',
            'serial_number' => 'nullable|string|max:100',
            'purchase_order_number' => 'nullable|string|max:100',
            'purchase_price' => 'nullable|numeric',
            'quantity' => 'required|integer',
            'condition' => 'required|string|max:50',
            'status' => 'required|string|max:50',
            'remaks' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'asset_detail_url' => 'nullable|url',
            'qr_code_path' => 'nullable|string|max:255',
            'date_of_receipt' => 'required|date',
            'category_id' => 'required|integer|exists:category,id',
            'subcategory_id' => 'required|integer|exists:subcategory,id',
            'number' => 'nullable|integer'
        ]);

        // Memperbarui asset dengan data yang valid
        $asset->update($validatedData);

        // Mengembalikan asset yang telah diperbarui dalam format JSON
        return response()->json($asset);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Mengambil asset berdasarkan ID
        $asset = Asset::find($id);

        // Memeriksa apakah asset ditemukan
        if (!$asset) {
            return response()->json(['message' => 'Asset not found'], 404);
        }

        // Menghapus asset
        $asset->delete();

        // Mengembalikan respons sukses
        return response()->json(['message' => 'Asset deleted successfully'], 200);
    }
}
