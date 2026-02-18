<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Review; // <--- 1. LOS MODELOS VAN AQUÍ ARRIBA (FUERA DE LA CLASE)
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    // ¡AQUÍ DENTRO NO SE PONEN LOS 'use App\Models...'!

    public function index(Request $request)
    {
        $query = Book::query();

        if ($request->has('genre') && $request->genre != null) {
            $query->where('genre', $request->genre);
        }

        $books = $query->with('reviews.user')->latest()->get();

        return Inertia::render('Books/Index', [
            'books' => $books,
            'currentGenre' => $request->genre ?? 'Todos'
        ]);
    }

    public function storeReview(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'comment' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Review::updateOrCreate(
            ['user_id' => Auth::id(), 'book_id' => $request->book_id],
            ['comment' => $request->comment, 'rating' => $request->rating]
        );

        return back();
    }

    public function destroyReview(Review $review)
    {
        if ($review->user_id === Auth::id() || Auth::user()->role === 'admin') {
            $review->delete();
        }
        return back();
    }
}