<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subcategory;

class SubcategoryController 
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Subcategory::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string',
            'code' => 'required|string|max:3',
            'category_id' => 'required|exists:category,id',
        ]);

        $subcategory = Subcategory::create($validate);

        return response()->json($subcategory, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $subcategory = Subcategory::find($id);

        if(!$subcategory){
            return response()->json(['message' => 'subcategory not found'], 404);
        }

        return response()->json($subcategory);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $subcategory = Subcategory::find($id);

        if(!$subcategory){
            return response()->json(['message' => 'subcategory not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subcategory = Subcategory::find($id);

        if(!$subcategory){
            return response()->json(['message' => 'subcategory not found'], 404);
        }
    }
}
