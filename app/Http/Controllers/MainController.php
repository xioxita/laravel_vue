<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        // Definimos las "funcionalidades" (Cards) que verá el usuario logueado
        $cards = [
            [
                'title' => 'Terror',
                'description' => 'Pasa miedo con nuestra colección.',
                'img' => 'https://images.unsplash.com/photo-1505664194779-8beaceb93744?auto=format&fit=crop&w=500&q=80',
                // Aquí generamos la ruta con el parámetro para filtrar
                'action' => route('books.index', ['genre' => 'Terror'])
            ],
            [
                'title' => 'Romance',
                'description' => 'Historias de amor apasionantes.',
                'img' => 'https://images.unsplash.com/photo-1518621736915-f3b1c41bfd00?auto=format&fit=crop&w=500&q=80',
                'action' => route('books.index', ['genre' => 'Romance'])
            ],
            [
                'title' => 'Ciencia Ficción',
                'description' => 'Viaja a otros mundos.',
                'img' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?auto=format&fit=crop&w=500&q=80',
                'action' => route('books.index', ['genre' => 'Ciencia Ficción'])
            ],
            [
                'title' => 'Fantasía',
                'description' => 'Magia, espadas y brujería.',
                'img' => 'https://images.unsplash.com/photo-1518709268805-4e9042af9f23?auto=format&fit=crop&w=500&q=80',
                'action' => route('books.index', ['genre' => 'Fantasía'])
            ],
        ];

        return Inertia::render('Main', [
            'cards' => $cards
        ]);
    }
}