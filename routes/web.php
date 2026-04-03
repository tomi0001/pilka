<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile.showGroup', [ProfileController::class, 'showGroup'])->name('profile.showGroup');
    Route::get('/profile.showCountries', [ProfileController::class, 'showCountries'])->name('profile.showCountries');
    Route::get('/profile.showGroupForm', [ProfileController::class, 'showGroupForm'])->name('profile.showGroupForm');
    Route::get('/profile.addGroup', [ProfileController::class, 'addGroup'])->name('profile.addGroup');
    Route::get('/profile.addGroupSubmit', [ProfileController::class, 'addGroupSubmit'])->name('profile.addGroupSubmit');
    Route::get('/profile.addCountry', [ProfileController::class, 'addCountry'])->name('profile.addCountry');
    Route::get('/profile.addGame', [ProfileController::class, 'addGame'])->name('profile.addGame');
    Route::get('/profile.addGameSubmit', [ProfileController::class, 'addGameSubmit'])->name('profile.addGameSubmit');
    Route::get('/profile.addCountrySubmit', [ProfileController::class, 'addCountrySubmit'])->name('profile.addCountrySubmit');
});

require __DIR__.'/auth.php';
