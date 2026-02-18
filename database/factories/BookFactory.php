<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Array de portadas falsas para que quede bonito
        $covers = [
            'https://images.unsplash.com/photo-1544947950-fa07a98d237f?auto=format&fit=crop&q=80&w=400',
            'https://images.unsplash.com/photo-1512820790803-83ca734da794?auto=format&fit=crop&q=80&w=400',
            'https://images.unsplash.com/photo-1589829085413-56de8ae18c73?auto=format&fit=crop&q=80&w=400'
        ];

        return [
            'title' => fake()->sentence(3),
            'author' => fake()->name(),
            'genre' => fake()->randomElement(['Terror', 'Romance', 'Ciencia Ficción', 'Fantasía']),
            'description' => fake()->paragraph(),
            'rating' => fake()->numberBetween(1, 5),
            'cover_image' => fake()->randomElement($covers),
        ];
    }
}
