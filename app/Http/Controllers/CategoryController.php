<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController 
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Category::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'code' => 'required|string|max:3',
            'remaks' => 'required|string',
        ]);

        $category = Category::create($validatedData);
        return response()->json($category, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);

        if(!$category){
            return response()->json(['message' => 'category not found'], 404);
        }

        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);

        if(!$category){
            return response()->json(['message' => 'category not found'], 404);
        }

        $validatedData = $request->validate([
            'name' => 'required|string',
            'code' => 'required|string|max:3',
            'remaks' => 'required|string',
        ]);

        // Memperbarui asset dengan data yang valid
        $category->update($validatedData);

        // Mengembalikan category yang telah diperbarui dalam format JSON
        return response()->json($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);

        if(!$category){
            return response()->json(['message' => 'category not found'], 404);
        }

        $category->delete();

        // Mengembalikan respons sukses
        return response()->json(['message' => 'Asset deleted successfully'], 200);
    }
}
