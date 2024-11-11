<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subcategory;
use Illuminate\Http\JsonResponse;

class SubcategoryController
{
    /**
     * Display a listing of the subcategories.
     */
    public function index(): JsonResponse
    {
        $subcategories = Subcategory::all();

        return response()->json([
            'status_code' => 200,
            'message' => 'Subcategories retrieved successfully',
            'data' => $subcategories
        ]);
    }

    /**
     * Store a newly created subcategory.
     */
    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate($this->validationRules());

        $subcategory = Subcategory::create($validatedData);

        return response()->json([
            'status_code' => 201,
            'message' => 'Subcategory created successfully',
            'data' => $subcategory
        ], 201);
    }

    /**
     * Display the specified subcategory.
     */
    public function show(string $id): JsonResponse
    {
        $subcategory = $this->findSubcategoryOrFail($id);

        return response()->json([
            'status_code' => 200,
            'message' => 'Subcategory retrieved successfully',
            'data' => $subcategory
        ]);
    }

    /**
     * Update the specified subcategory.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $subcategory = $this->findSubcategoryOrFail($id);

        $validatedData = $request->validate($this->validationRules());

        $subcategory->update($validatedData);

        return response()->json([
            'status_code' => 200,
            'message' => 'Subcategory updated successfully',
            'data' => $subcategory
        ]);
    }

    /**
     * Remove the specified subcategory.
     */
    public function destroy(string $id): JsonResponse
    {
        $subcategory = $this->findSubcategoryOrFail($id);

        $subcategory->delete();

        return response()->json([
            'status_code' => 200,
            'message' => 'Subcategory deleted successfully'
        ]);
    }

    /**
     * Validation rules for storing and updating subcategories.
     */
    private function validationRules(): array
    {
        return [
            'name' => 'required|string',
            'code' => 'required|string|max:3',
            'category_id' => 'required|exists:categories,id',
        ];
    }

    /**
     * Find a subcategory by ID or return a 404 error response.
     */
    private function findSubcategoryOrFail(string $id): Subcategory
    {
        $subcategory = Subcategory::find($id);

        if (!$subcategory) {
            abort(response()->json([
                'status_code' => 404,
                'message' => 'Subcategory not found'
            ], 404));
        }

        return $subcategory;
    }
}
