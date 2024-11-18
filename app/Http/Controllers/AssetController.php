<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asset;
use App\Models\Category;
use App\Models\Subcategory;

class AssetController
{
    public function index()
    {
        $assets = Asset::paginate(10); 
        return view('page.asset.index', compact('assets'));
    }

    public function create()
    {
        $categories = Category::select('id', 'name')->get();
        $subcategories = Subcategory::select('id', 'name', 'category_id')->get();
        return view('page.asset.create', compact('categories', 'subcategories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate($this->validationRules());
        Asset::create($validatedData);
        return redirect()->route('assets.index')
            ->with('message', 'Asset created successfully');
    }

    public function show(int $id)
    {
        $asset = $this->findAssetOrFail($id);
        return view('page.asset.show', compact('asset'));
    }

    public function edit(int $id)
    {
        $asset = $this->findAssetOrFail($id);
        $categories = Category::select('id', 'name')->get();
        $subcategories = Subcategory::select('id', 'name', 'category_id')->get();
        return view('page.asset.edit', compact('asset', 'categories', 'subcategories'));
    }

    public function update(Request $request, int $id)
    {
        $asset = $this->findAssetOrFail($id);
        $validatedData = $request->validate($this->validationRules());
        $asset->update($validatedData);
        return redirect()->route('assets.index')
            ->with('message', 'Asset updated successfully');
    }

    public function destroy(int $id)
    {
        $asset = $this->findAssetOrFail($id);
        $asset->delete();
        return redirect()->route('assets.index')
            ->with('message', 'Asset deleted successfully');
    }

    public function downloadQr($id)
    {
        $asset = $this->findAssetOrFail($id);
        $qrPath = $asset->getQrCodePath();
        
        return response()->download(
            public_path('qrcodes/' . $qrPath),
            $qrPath,
            [
                'Content-Type' => 'image/png',
                'Content-Disposition' => 'attachment'
            ]
        );
    }

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
            'remarks' => 'nullable|string', 
            'location' => 'nullable|string|max:255',
            'asset_detail_url' => 'nullable|url',
            'qr_code_path' => 'nullable|string|max:255',
            'date_of_receipt' => 'required|date',
            'category_id' => 'required|integer|exists:categories,id', 
            'subcategory_id' => 'required|integer|exists:subcategories,id', 
            'number' => 'nullable|integer'
        ];
    }

    private function findAssetOrFail(int $id): Asset
    {
        $asset = Asset::find($id);

        if (!$asset) {
            abort(404, 'Asset not found');
        }

        return $asset;
    }
}
