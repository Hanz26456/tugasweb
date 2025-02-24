<?php
use App\Http\Controllers\BookController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoanController;
use Illuminate\Support\Facades\Route;

Route::apiResource('books', BookController::class);
Route::apiResource('members', MemberController::class);
Route::apiResource('staff', StaffController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('loans', LoanController::class);
