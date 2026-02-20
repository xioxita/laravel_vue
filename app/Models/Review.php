<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // <--- 1. IMPORTANTE
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'book_id', 'comment', 'rating'];

    // una reseña pertenece a un Usuario
    public function user() {
        return $this->belongsTo(User::class);
    }

    // una reseña pertenece a un Libro
    public function book() {
        return $this->belongsTo(Book::class);
    }
}