<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Mengarahkan halaman utama ke daftar buku
Route::get('/', [BookController::class, 'index'])->name('books.index');
Route::resource('members', MemberController::class);
Route::resource('loans', LoanController::class);
Route::resource('categories', CategoryController::class);
Route::get('/members/{member}/history', [MemberController::class, 'history'])->name('members.history');
Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');
Route::put('/members/{member}', [MemberController::class, 'update'])->name('members.update');
Route::get('/members/{member}/history/pdf', [MemberController::class, 'exportPdf'])->name('members.history.pdf');


// Halaman statis
Route::get('/about', function () {
    return view('pages.about');
});

Route::get('/services', function () {
    return view('pages.services');
});

Route::get('/portfolio', function () {
    return view('pages.portfolio');
});

Route::get('/team', function () {
    return view('pages.team');
});

Route::get('/contact', function () {
    return view('pages.contact');
});

// Mengaktifkan CRUD untuk Buku
Route::resource('books', BookController::class);

// Dashboard hanya untuk pengguna yang sudah login & terverifikasi
Route::get('/dashboard', function () {
    return view('pagesadmin.dashboard');
})->middleware(['auth', 'verified'])->name('pagesadmin.dashboard');

// Grup middleware untuk autentikasi
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Autentikasi (Login, Register, dll.)
require __DIR__.'/auth.php';
