<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::query();

        // si el usuario le dió click a un genero entonces filtra a los libros de ese genero
        if ($request->has('genre') && $request->genre != null) {
            $query->where('genre', $request->genre);
        }

        // se guarda el valor de la consulta de esos libros, con las reseñas de los usuarios
        // del mas nuevo al ma s antiguo
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

        // si el el usuario coincide con el loggeado, y el id del libro es el mismo q la peticion
        // entonces se actualiza el comentario o valoracion, sino se crea
        Review::updateOrCreate(
            ['user_id' => Auth::id(), 'book_id' => $request->book_id],
            ['comment' => $request->comment, 'rating' => $request->rating]
        );

        return back();
    }

    public function destroyReview(Review $review)
    {
        if ($review->user_id === Auth::id()) {
            $review->delete();
        }
        return back();
    }
}