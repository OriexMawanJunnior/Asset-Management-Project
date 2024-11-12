<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;


class EmployeeController
{
    /**
     * Display a listing of the employees.
     */
    public function index()
    {
        $employees = Employee::paginate(10);
        return view('page.user.index', compact('employees'));
    }

    /**
     * Show the form for creating a new employee.
     */
    public function create()
    {
        return view('page.user.create');
    }

    /**
     * Store a newly created employee in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate($this->validationRules());
        Employee::create($validatedData);
        return redirect()->route('users.index')
            ->with('message', 'Employee created successfully');
    }

    /**
     * Display the specified employee.
     */
    public function show(string $id)
    {
        $employee = $this->findEmployeeOrFail($id);
        return view('page.user.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified employee.
     */
    public function edit(string $id)
    {
        $employee = $this->findEmployeeOrFail($id);
        return view('page.user.edit', compact('employee'));
    }

    /**
     * Update the specified employee in storage.
     */
    public function update(Request $request, string $id)
    {
        $employee = $this->findEmployeeOrFail($id);
        $validatedData = $request->validate($this->validationRules());
        $employee->update($validatedData);
        return redirect()->route('users.index')
            ->with('message', 'Employee updated successfully');
    }

    /**
     * Remove the specified employee from storage.
     */
    public function destroy(string $id)
    {
        $employee = $this->findEmployeeOrFail($id);
        $employee->delete();
        return redirect()->route('users.index')
            ->with('message', 'Employee deleted successfully');
    }

    /**
     * Validation rules for storing and updating employees.
     */
    private function validationRules(): array
    {
        return [
            'name' => 'required|string',
            'organization' => 'required|string',
            'job_position' => 'required|string',
        ];
    }

    /**
     * Find an employee by ID or return a 404 error response.
     */
    private function findEmployeeOrFail(string $id): Employee
    {
        $employee = Employee::find($id);

        if (!$employee) {
            abort(404, 'Employee not found');
        }

        return $employee;
    }
}
