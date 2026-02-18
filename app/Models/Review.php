<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // <--- 1. IMPORTANTE
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory; // <--- 2. ESTO ES LO QUE TE FALTA

    protected $fillable = ['user_id', 'book_id', 'comment', 'rating'];

    // Relación: Una reseña pertenece a un Usuario
    public function user() {
        return $this->belongsTo(User::class);
    }

    // Relación: Una reseña pertenece a un Libro
    public function book() {
        return $this->belongsTo(Book::class);
    }
}