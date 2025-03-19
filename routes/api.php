<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\Api\BookController;  // Import controller API yang benar

Route::apiResource('books', BookController::class);
Route::apiResource('members', MemberController::class);
Route::apiResource('staff', StaffController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('loans', LoanController::class);

