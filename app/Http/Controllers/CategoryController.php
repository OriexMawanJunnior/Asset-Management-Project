<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoryController
{
    /**
     * Display a listing of the categories.
     */
    public function index(): JsonResponse
    {
        $categories = Category::all();

        return response()->json([
            'status_code' => 200,
            'message' => 'Categories retrieved successfully',
            'data' => $categories
        ]);
    }

    /**
     * Store a newly created category.
     */
    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate($this->validationRules());

        $category = Category::create($validatedData);

        return response()->json([
            'status_code' => 201,
            'message' => 'Category created successfully',
            'data' => $category
        ], 201);
    }

    /**
     * Display the specified category.
     */
    public function show(string $id): JsonResponse
    {
        $category = $this->findCategoryOrFail($id);

        return response()->json([
            'status_code' => 200,
            'message' => 'Category retrieved successfully',
            'data' => $category
        ]);
    }

    /**
     * Update the specified category.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $category = $this->findCategoryOrFail($id);

        $validatedData = $request->validate($this->validationRules());

        $category->update($validatedData);

        return response()->json([
            'status_code' => 200,
            'message' => 'Category updated successfully',
            'data' => $category
        ]);
    }

    /**
     * Remove the specified category.
     */
    public function destroy(string $id): JsonResponse
    {
        $category = $this->findCategoryOrFail($id);

        $category->delete();

        return response()->json([
            'status_code' => 200,
            'message' => 'Category deleted successfully'
        ]);
    }

    /**
     * Validation rules for storing and updating categories.
     */
    private function validationRules(): array
    {
        return [
            'name' => 'required|string',
            'code' => 'required|string|max:3',
            'remaks' => 'required|string',
        ];
    }

    /**
     * Find a category by ID or return a 404 error response.
     */
    private function findCategoryOrFail(string $id): Category
    {
        $category = Category::find($id);

        if (!$category) {
            abort(response()->json([
                'status_code' => 404,
                'message' => 'Category not found'
            ], 404));
        }

        return $category;
    }
}
