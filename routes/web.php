<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
});


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
// Route::get('/home', function () {
//     return view('pages.home');
// });

Route::get('/dashboard', function () {
    return view('pagesadmin.dashboard');
})->middleware(['auth', 'verified'])->name('pagesadmin.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
