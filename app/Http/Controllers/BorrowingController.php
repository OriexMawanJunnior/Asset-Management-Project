<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Borrowing;
use Illuminate\Support\Facades\DB;

class BorrowingController
{
    public function index()
    {
        $borrowings = Borrowing::paginate(10);
        return view('page.borrowing.index', compact('borrowings'));
    }

    public function create()
    {
        $assets = Asset::select('id', 'asset_id', 'name')->get();
        $employees = Employee::select('id', 'name')->get();
        return view('page.borrowing.create', compact('assets', 'employees'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate($this->validationRules());

        DB::transaction(function () use ($validatedData) {
            Borrowing::create($validatedData);

            $asset = Asset::findOrFail($validatedData['asset_id']);
            $employee = Employee::findOrFail($validatedData['employee_id']);
            
            $asset->update([
                'location' => $employee->name,
                'status' => 'borrowed'
            ]);
        });

        return redirect()->route('borrowings.index')
            ->with('message', 'Borrowing created successfully for asset: ' . $validatedData['asset_id']);
    }

    public function show(int $id)
    {
        $borrowing = $this->findBorrowingOrFail($id);
        return view('page.borrowing.show', compact('borrowing'));
    }

    public function edit(int $id)
    {
        $borrowing = $this->findBorrowingOrFail($id);
        $assets = Asset::select('id', 'asset_id', 'name')->get();
        $employees = Employee::select('id', 'name')->get();
        return view('page.borrowing.edit', compact('borrowing', 'assets', 'employees'));
    }

    public function update(Request $request, int $id)
    {
        $borrowing = $this->findBorrowingOrFail($id);
        $validatedData = $request->validate($this->validationRules());
        $borrowing->update($validatedData);
        return redirect()->route('borrowings.index')
            ->with('message', 'Borrowing updated successfully for asset: ' . $borrowing->asset->asset_id);
    }

    public function destroy(int $id)
    {
        $borrowing = $this->findBorrowingOrFail($id);
        $borrowing->delete();

        return redirect()->route('borrowings.index')
            ->with('message', 'Borrowing deleted successfully');
    }

    private function validationRules(): array
    {
        return [
            'date_of_receipt' => 'required|date',
            'date_of_return' => 'required|date|after:date_of_receipt',
            'status' => 'required|in:borrowed,returned,late',
            'asset_id' => 'required|exists:assets,id',
            'employee_id' => 'required|exists:employees,id',
        ];
    }

    private function findBorrowingOrFail(int $id): Borrowing
    {
        $borrowing = Borrowing::find($id);

        if (!$borrowing) {
            abort(404, 'Borrowing not found');
        }

        return $borrowing;
    }
}
