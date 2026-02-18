<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\MainController;
use App\Http\Controllers\BookController; // Importamos el de Libros
use App\Http\Controllers\Admin\DashboardController;

Route::get("crono", fn()=>Inertia::render('Cronometro'));

//Route::get('/', function () {
//    return Inertia::render('Welcome', [
//        'canLogin' => Route::has('login'),
//        'canRegister' => Route::has('register'),
//        'laravelVersion' => Application::VERSION,
//        'phpVersion' => PHP_VERSION,
//    ]);
//});

Route::get('/', [MainController::class, 'index'])->name('main');
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::post('/reviews', [\App\Http\Controllers\BookController::class, 'storeReview'])->name('reviews.store');
Route::delete('/reviews/{review}', [\App\Http\Controllers\BookController::class, 'destroyReview'])->name('reviews.destroy');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // RUTA DEL ADMIN DASHBOARD
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
});


require __DIR__.'/auth.php';
