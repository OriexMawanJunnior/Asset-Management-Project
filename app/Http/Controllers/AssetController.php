<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asset;
use App\Models\Category;
use App\Models\Subcategory;

class AssetController
{
    /**
     * Display a listing of the assets.
     */
    public function index()
    {
        $assets = Asset::paginate(10); // 10 items per page
        return view('page.asset.index', compact('assets'));
    }

    /**
     * Show the form for creating a new asset.
     */
    public function create()
    {
        $categories = Category::select('id', 'name')->get();
        $subcategories = Subcategory::select('id', 'name', 'category_id')->get();
        return view('page.asset.create', compact('categories', 'subcategories'));
    }

    /**
     * Store a newly created asset in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate($this->validationRules());
        Asset::create($validatedData);
        return redirect()->route('assets.index')
            ->with('message', 'Asset created successfully');
    }

    /**
     * Display the specified asset.
     */
    public function show(string $id)
    {
        $asset = $this->findAssetOrFail($id);
        return view('page.asset.show', compact('asset'));
    }

    /**
     * Show the form for editing the specified asset.
     */
    public function edit(string $id)
    {
        $asset = $this->findAssetOrFail($id);
        $categories = Category::select('id', 'name')->get();
        $subcategories = Subcategory::select('id', 'name', 'category_id')->get();
        return view('page.asset.edit', compact('asset', 'categories', 'subcategories'));
    }

    /**
     * Update the specified asset in storage.
     */
    public function update(Request $request, string $id)
    {
        $asset = $this->findAssetOrFail($id);
        $validatedData = $request->validate($this->validationRules());
        $asset->update($validatedData);
        return redirect()->route('assets.index')
            ->with('message', 'Asset updated successfully');
    }

    /**
     * Remove the specified asset from storage.
     */
    public function destroy(string $id)
    {
        $asset = $this->findAssetOrFail($id);
        $asset->delete();
        return redirect()->route('assets.index')
            ->with('message', 'Asset deleted successfully');
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
            abort(404, 'Asset not found');
        }

        return $asset;
    }
}
