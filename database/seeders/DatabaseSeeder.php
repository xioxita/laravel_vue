<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // 20 Usuarios rndom para que escriban reseñas
        $randomUsers = User::factory(20)->create();

        $library = [
            // --- TERROR ---
            [
                'title' => 'It (Eso)',
                'author' => 'Stephen King',
                'genre' => 'Terror',
                'description' => 'Un antiguo mal acecha bajo el pueblo de Derry, tomando la forma de las peores pesadillas de los niños.',
                'cover_image' => 'https://images.unsplash.com/photo-1505664194779-8beaceb93744?auto=format&fit=crop&w=400&q=80'
            ],
            [
                'title' => 'El Resplandor',
                'author' => 'Stephen King',
                'genre' => 'Terror',
                'description' => 'Jack Torrance acepta un trabajo como vigilante de invierno en un hotel aislado, pero el hotel tiene otros planes.',
                'cover_image' => 'https://images.unsplash.com/photo-1505664194779-8beaceb93744?auto=format&fit=crop&w=400&q=80'
            ],
            [
                'title' => 'Drácula',
                'author' => 'Bram Stoker',
                'genre' => 'Terror',
                'description' => 'La historia del vampiro más famoso que se muda de Transilvania a Inglaterra para buscar sangre nueva.',
                'cover_image' => 'https://images.unsplash.com/photo-1505664194779-8beaceb93744?auto=format&fit=crop&w=400&q=80'
            ],
            [
                'title' => 'El Exorcista',
                'author' => 'William Peter Blatty',
                'genre' => 'Terror',
                'description' => 'Una madre desesperada recurre a dos sacerdotes para salvar a su hija de una entidad demoníaca.',
                'cover_image' => 'https://images.unsplash.com/photo-1505664194779-8beaceb93744?auto=format&fit=crop&w=400&q=80'
            ],
            [
                'title' => 'Frankenstein',
                'author' => 'Mary Shelley',
                'genre' => 'Terror',
                'description' => 'El científico Víctor Frankenstein da vida a una criatura hecha de partes de cadáveres, con consecuencias trágicas.',
                'cover_image' => 'https://images.unsplash.com/photo-1505664194779-8beaceb93744?auto=format&fit=crop&w=400&q=80'
            ],

            // --- FANTASÍA ---
            [
                'title' => 'Harry Potter y la Piedra Filosofal',
                'author' => 'J.K. Rowling',
                'genre' => 'Fantasía',
                'description' => 'Un niño descubre que es un mago y comienza su educación en la escuela de magia Hogwarts.',
                'cover_image' => 'https://images.unsplash.com/photo-1518709268805-4e9042af9f23?auto=format&fit=crop&w=400&q=80'
            ],
            [
                'title' => 'El Señor de los Anillos',
                'author' => 'J.R.R. Tolkien',
                'genre' => 'Fantasía',
                'description' => 'Frodo Bolsón emprende un peligroso viaje para destruir el Anillo Único y salvar la Tierra Media.',
                'cover_image' => 'https://images.unsplash.com/photo-1518709268805-4e9042af9f23?auto=format&fit=crop&w=400&q=80'
            ],
            [
                'title' => 'Juego de Tronos',
                'author' => 'George R.R. Martin',
                'genre' => 'Fantasía',
                'description' => 'Las familias nobles de los Siete Reinos luchan por el control del Trono de Hierro.',
                'cover_image' => 'https://images.unsplash.com/photo-1518709268805-4e9042af9f23?auto=format&fit=crop&w=400&q=80'
            ],
            [
                'title' => 'El Nombre del Viento',
                'author' => 'Patrick Rothfuss',
                'genre' => 'Fantasía',
                'description' => 'Kvothe relata su vida, desde su infancia en una troupe de artistas hasta sus años en la Universidad.',
                'cover_image' => 'https://images.unsplash.com/photo-1518709268805-4e9042af9f23?auto=format&fit=crop&w=400&q=80'
            ],
            [
                'title' => 'El Hobbit',
                'author' => 'J.R.R. Tolkien',
                'genre' => 'Fantasía',
                'description' => 'Bilbo Bolsón es arrastrado a una aventura épica para recuperar el reino enano de Erebor.',
                'cover_image' => 'https://images.unsplash.com/photo-1518709268805-4e9042af9f23?auto=format&fit=crop&w=400&q=80'
            ],

            // --- CIENCIA FICCIÓN ---
            [
                'title' => 'Dune',
                'author' => 'Frank Herbert',
                'genre' => 'Ciencia Ficción',
                'description' => 'En el desértico planeta Arrakis, Paul Atreides debe liderar una rebelión contra un imperio galáctico.',
                'cover_image' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?auto=format&fit=crop&w=400&q=80'
            ],
            [
                'title' => 'El Juego de Ender',
                'author' => 'Orson Scott Card',
                'genre' => 'Ciencia Ficción',
                'description' => 'Un niño prodigio es entrenado en una escuela espacial para liderar la guerra contra una raza alienígena.',
                'cover_image' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?auto=format&fit=crop&w=400&q=80'
            ],
            [
                'title' => 'Fahrenheit 451',
                'author' => 'Ray Bradbury',
                'genre' => 'Ciencia Ficción',
                'description' => 'En un futuro donde los libros están prohibidos, un bombero encargado de quemarlos comienza a cuestionar su realidad.',
                'cover_image' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?auto=format&fit=crop&w=400&q=80'
            ],
            [
                'title' => '1984',
                'author' => 'George Orwell',
                'genre' => 'Ciencia Ficción',
                'description' => 'Winston Smith lucha contra un régimen totalitario que vigila cada movimiento de sus ciudadanos.',
                'cover_image' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?auto=format&fit=crop&w=400&q=80'
            ],
            [
                'title' => 'Yo, Robot',
                'author' => 'Isaac Asimov',
                'genre' => 'Ciencia Ficción',
                'description' => 'Una colección de historias que exploran las tres leyes de la robótica y la relación entre humanos y máquinas.',
                'cover_image' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?auto=format&fit=crop&w=400&q=80'
            ],

            // --- ROMANCE ---
            [
                'title' => 'Orgullo y Prejuicio',
                'author' => 'Jane Austen',
                'genre' => 'Romance',
                'description' => 'Elizabeth Bennet y el Sr. Darcy deben superar sus prejuicios para encontrar el amor verdadero.',
                'cover_image' => 'https://images.unsplash.com/photo-1518621736915-f3b1c41bfd00?auto=format&fit=crop&w=400&q=80'
            ],
            [
                'title' => 'Bajo la Misma Estrella',
                'author' => 'John Green',
                'genre' => 'Romance',
                'description' => 'Dos adolescentes con cáncer se enamoran y aprenden a vivir el momento en un viaje a Ámsterdam.',
                'cover_image' => 'https://images.unsplash.com/photo-1518621736915-f3b1c41bfd00?auto=format&fit=crop&w=400&q=80'
            ],
            [
                'title' => 'El Diario de Noa',
                'author' => 'Nicholas Sparks',
                'genre' => 'Romance',
                'description' => 'La historia de amor eterno entre Noah y Allie, leída desde un diario en una residencia de ancianos.',
                'cover_image' => 'https://images.unsplash.com/photo-1518621736915-f3b1c41bfd00?auto=format&fit=crop&w=400&q=80'
            ],
            [
                'title' => 'Yo antes de ti',
                'author' => 'Jojo Moyes',
                'genre' => 'Romance',
                'description' => 'Louisa Clark acepta un trabajo cuidando a un hombre tetrapléjico y cambia su vida para siempre.',
                'cover_image' => 'https://images.unsplash.com/photo-1518621736915-f3b1c41bfd00?auto=format&fit=crop&w=400&q=80'
            ],
            [
                'title' => 'Cumbres Borrascosas',
                'author' => 'Emily Brontë',
                'genre' => 'Romance',
                'description' => 'La intensa y destructiva historia de amor entre Heathcliff y Catherine en los páramos de Yorkshire.',
                'cover_image' => 'https://images.unsplash.com/photo-1518621736915-f3b1c41bfd00?auto=format&fit=crop&w=400&q=80'
            ],
        ];

        foreach ($library as $bookData) {
            $book = Book::create([
                'title' => $bookData['title'],
                'author' => $bookData['author'],
                'genre' => $bookData['genre'],
                'description' => $bookData['description'] ?? 'Desc',
                'cover_image' => $bookData['cover_image'] ?? '',
                'rating' => rand(3, 5),
            ]);

            $reviewers = $randomUsers->random(rand(3, 8));

            foreach ($reviewers as $reviewer) {
                \App\Models\Review::factory()->create([
                    'user_id' => $reviewer->id,
                    'book_id' => $book->id,
                ]);
            }
        }
    }
}