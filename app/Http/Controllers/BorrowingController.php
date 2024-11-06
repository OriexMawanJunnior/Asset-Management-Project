<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Borrowing;

class BorrowingController 
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Borrowing::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'date_of_receipt' => 'required|date',
            'date_of_return' => 'nullable|date',
            'status' => 'required|in:borrowed,returned,late',
            'asset_id' => 'required|exists:assets, asset_id',
            'employee_id' => 'required|exists:employee, id',
        ]);

        $borrowing = Borrowing::create($validate);

        return response()->json($borrowing, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $borrowing = Borrowing::find($id);

        if(!$borrowing){
            return response()->json(['message' => 'borrowing not found'], 404);
        }

        return response()->json($borrowing);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $borrowing = Borrowing::find($id);

        if(!$borrowing){
            return response()->json(['message' => 'borrowing not found'], 404);
        }

        $validate = $request->validate([
            'date_of_receipt' => 'required|date',
            'date_of_return' => 'nullable|date',
            'status' => 'required|in:borrowed,returned,late',
            'asset_id' => 'required|exists:assets, asset_id',
            'employee_id' => 'required|exists:employee, id',
        ]);

        $borrowing->update($validate);

        return response()->json($borrowing);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $borrowing = Borrowing::find($id);

        if(!$borrowing){
            return response()->json(['message' => 'borrowing not found'], 404);
        }

        $borrowing->delete();

        return response()->json(['message' => 'deleted is succesfull'], 200);
    }
}
