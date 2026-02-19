<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\MainController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\Admin\DashboardController;

// RUTAS PÚBLICAS (Cualquiera puede entrar)
Route::get("crono", fn()=>Inertia::render('Cronometro'));
Route::get('/', [MainController::class, 'index'])->name('main');

// RUTAS PROTEGIDAS (Solo usuarios logueados)
Route::middleware('auth')->group(function () {

    // Libros y Reseñas (MOVIDAS AQUÍ)
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::post('/reviews', [BookController::class, 'storeReview'])->name('reviews.store');
    Route::delete('/reviews/{review}', [BookController::class, 'destroyReview'])->name('reviews.destroy');

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // RUTA DEL ADMIN DASHBOARD
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
});

require __DIR__.'/auth.php';