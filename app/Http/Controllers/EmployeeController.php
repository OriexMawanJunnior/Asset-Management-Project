<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController 
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Employee::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string',
            'departement' => 'required|string',
        ]);

        $employee = Employee::create($validate);

        return response()->json($employee, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employee::find($id);

        if(!$employee){
            return response()->json(['message' => 'employee not found'], 404);
        }

        return response()->json($employee);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $employee = Employee::find($id);

        if(!$employee){
            return response()->json(['message' => 'employee not found'], 404);
        }

        $validate = $request->validate([
            'name' => 'required|string',
            'departement' => 'required|string',
        ]);

        $employee->update($validate);

        return response()->json($employee, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::find($id);

        if(!$employee){
            return response()->json(['message' => 'employee not found'], 404);
        }

        $employee->delete();

        return response()->json(['message'=> 'employee deleted']);
    }
}
