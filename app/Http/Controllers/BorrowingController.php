<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Borrowing;


class BorrowingController
{
    /**
     * Display a listing of the borrowings.
     */
    public function index()
    {
        $borrowings = Borrowing::paginate(10);
        return view('page.borrowing.index', compact('borrowings'));
    }

    /**
     * Store a newly created borrowing.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate($this->validationRules());

        $borrowing = Borrowing::create($validatedData);

        return response()->json([
            'status_code' => 201,
            'message' => 'Borrowing created successfully',
            'data' => $borrowing
        ], 201);
    }

    /**
     * Display the specified borrowing.
     */
    public function show(string $id)
    {
        $borrowing = $this->findBorrowingOrFail($id);

        return response()->json([
            'status_code' => 200,
            'message' => 'Borrowing retrieved successfully',
            'data' => $borrowing
        ]);
    }

    /**
     * Update the specified borrowing.
     */
    public function update(Request $request, string $id)
    {
        $borrowing = $this->findBorrowingOrFail($id);

        $validatedData = $request->validate($this->validationRules());

        $borrowing->update($validatedData);

        return response()->json([
            'status_code' => 200,
            'message' => 'Borrowing updated successfully',
            'data' => $borrowing
        ]);
    }

    /**
     * Remove the specified borrowing.
     */
    public function destroy(string $id)
    {
        $borrowing = $this->findBorrowingOrFail($id);

        $borrowing->delete();

        return response()->json([
            'status_code' => 200,
            'message' => 'Borrowing deleted successfully'
        ]);
    }

    /**
     * Get validation rules for storing and updating borrowings.
     */
    private function validationRules(): array
    {
        return [
            'date_of_receipt' => 'required|date',
            'date_of_return' => 'nullable|date',
            'status' => 'required|in:borrowed,returned,late',
            'asset_id' => 'required|exists:assets,asset_id',
            'employee_id' => 'required|exists:employee,id',
        ];
    }

    /**
     * Find a borrowing by ID or return a 404 error response.
     */
    private function findBorrowingOrFail(string $id): Borrowing
    {
        $borrowing = Borrowing::find($id);

        if (!$borrowing) {
            abort(response()->json([
                'status_code' => 404,
                'message' => 'Borrowing not found'
            ], 404));
        }

        return $borrowing;
    }
}
