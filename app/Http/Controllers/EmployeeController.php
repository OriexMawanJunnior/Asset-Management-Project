<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Http\JsonResponse;

class EmployeeController
{
    /**
     * Display a listing of the employees.
     */
    public function index(): JsonResponse
    {
        $employees = Employee::all();

        return response()->json([
            'status_code' => 200,
            'message' => 'Employees retrieved successfully',
            'data' => $employees
        ]);
    }

    /**
     * Store a newly created employee.
     */
    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate($this->validationRules());

        $employee = Employee::create($validatedData);

        return response()->json([
            'status_code' => 201,
            'message' => 'Employee created successfully',
            'data' => $employee
        ], 201);
    }

    /**
     * Display the specified employee.
     */
    public function show(string $id): JsonResponse
    {
        $employee = $this->findEmployeeOrFail($id);

        return response()->json([
            'status_code' => 200,
            'message' => 'Employee retrieved successfully',
            'data' => $employee
        ]);
    }

    /**
     * Update the specified employee.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $employee = $this->findEmployeeOrFail($id);

        $validatedData = $request->validate($this->validationRules());

        $employee->update($validatedData);

        return response()->json([
            'status_code' => 200,
            'message' => 'Employee updated successfully',
            'data' => $employee
        ]);
    }

    /**
     * Remove the specified employee.
     */
    public function destroy(string $id): JsonResponse
    {
        $employee = $this->findEmployeeOrFail($id);

        $employee->delete();

        return response()->json([
            'status_code' => 200,
            'message' => 'Employee deleted successfully'
        ]);
    }

    /**
     * Validation rules for storing and updating employees.
     */
    private function validationRules(): array
    {
        return [
            'name' => 'required|string',
            'departement' => 'required|string',
        ];
    }

    /**
     * Find an employee by ID or return a 404 error response.
     */
    private function findEmployeeOrFail(string $id): Employee
    {
        $employee = Employee::find($id);

        if (!$employee) {
            abort(response()->json([
                'status_code' => 404,
                'message' => 'Employee not found'
            ], 404));
        }

        return $employee;
    }
}
