<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RecipeController;

// Public welcome page shows all recipes
Route::get('/', [RecipeController::class, 'index'])->name('welcome');

// Recipe routes
Route::controller(RecipeController::class)->group(function () {
    Route::get('/recipes', 'index')->name('recipes.index');

    // Authenticated recipe management
    Route::middleware('auth')->group(function () {
        Route::get('/recipes/create', 'create')->name('recipes.create');
        Route::post('/recipes', 'store')->name('recipes.store');
        Route::get('/recipes/{recipe}/edit', 'edit')->name('recipes.edit'); // Corrected
        Route::put('/recipes/{recipe}', 'update')->name('recipes.update');   // Corrected
        Route::delete('/recipes/{recipe}', 'destroy')->name('recipes.destroy'); // Corrected
    });

    // Public view of a single recipe
    Route::get('/recipes/{recipe}', 'show')->name('recipes.show'); // Corrected
});

// Auth routes
Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

// Authenticated user routes
Route::middleware('auth')->group(function () {
    // User dashboard with own recipes
    Route::get('/dashboard', function () {
        $recipes = \App\Models\Recipe::where('uid', auth()->id())->get();
        return view('dashboard', compact('recipes'));
    })->name('dashboard');

    // User profile management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';