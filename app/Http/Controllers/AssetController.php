<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asset;
use Illuminate\Http\JsonResponse;

class AssetController
{
    /**
     * Display a listing of the assets.
     */
    public function index()
    {
        $assets = Asset::paginate(10); // 10 items per halaman
        return view('page.asset', compact('assets'));
    }
    public function showCreateForm(){
        return view('page.asset.create');
    }

    /**
     * Store a new asset.
     */
    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate($this->validationRules());

        $asset = Asset::create($validatedData);

        return response()->json([
            'status_code' => 201,
            'message' => 'Asset created successfully',
            'data' => $asset
        ], 201);
    }

    /**
     * Display the specified asset.
     */
    public function show(string $id): JsonResponse
    {
        $asset = $this->findAssetOrFail($id);

        return response()->json([
            'status_code' => 200,
            'message' => 'Asset retrieved successfully',
            'data' => $asset
        ]);
    }

    /**
     * Update the specified asset.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $asset = $this->findAssetOrFail($id);

        $validatedData = $request->validate($this->validationRules());

        $asset->update($validatedData);

        return response()->json([
            'status_code' => 200,
            'message' => 'Asset updated successfully',
            'data' => $asset
        ]);
    }

    /**
     * Remove the specified asset.
     */
    public function destroy(string $id): JsonResponse
    {
        $asset = $this->findAssetOrFail($id);
        
        $asset->delete();

        return response()->json([
            'status_code' => 200,
            'message' => 'Asset deleted successfully'
        ]);
    }

    /**
     * Get validation rules for storing and updating assets.
     */
    private function validationRules(): array
    {
        return [
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
        ];
    }

    /**
     * Find an asset by ID or return a 404 error response.
     */
    private function findAssetOrFail(string $id): Asset
    {
        $asset = Asset::find($id);

        if (!$asset) {
            abort(response()->json([
                'status_code' => 404,
                'message' => 'Asset not found'
            ], 404));
        }

        return $asset;
    }
}
