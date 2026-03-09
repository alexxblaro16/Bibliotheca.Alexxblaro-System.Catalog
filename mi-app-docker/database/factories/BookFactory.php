<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
public function definition(): array
{
    return [
        'titulo' => $this->faker->unique()->sentence(3), // Genera títulos únicos
        'autor' => $this->faker->name(),
        'anio_publicacion' => $this->faker->year(),
        'categoria' => $this->faker->randomElement(['Fantasía', 'Ciencia Ficción', 'Clásicos']),
        'disponible' => $this->faker->boolean(),
    ];
}
}