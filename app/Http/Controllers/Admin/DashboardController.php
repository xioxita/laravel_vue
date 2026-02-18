<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Review;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Seguridad simple: Si no es admin, lo echamos al inicio
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('main');
        }

        return Inertia::render('Admin/Dashboard', [
            // 1. Tarjetas de contadores
            'stats' => [
                'total_users' => User::count(),
                'total_books' => Book::count(),
                'total_reviews' => Review::count(),
                'avg_rating' => round(Review::avg('rating'), 1), // Promedio global
            ],

            // 2. Top 5 Libros mejor valorados
            'top_books' => Book::orderByDesc('rating')
                ->take(5)
                ->get(['id', 'title', 'cover_image', 'rating']),

            // 3. Últimas 5 reseñas escritas (con el usuario que la escribió)
            'latest_reviews' => Review::with(['user', 'book'])
                ->latest()
                ->take(5)
                ->get()
        ]);
    }
}