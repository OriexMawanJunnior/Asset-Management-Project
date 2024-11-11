<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\SubcategoryController;





// Protected routes
Route::middleware('auth:sanctum')->group(function () {
 

    Route::apiResource('employees', EmployeeController::class);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('subcategories', SubcategoryController::class);
    Route::apiResource('borrowings', BorrowingController::class);
});

