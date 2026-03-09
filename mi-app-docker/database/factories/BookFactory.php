<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    public function definition(): array
    {
        return [
            'titulo' => $this->faker->sentence(3), 
            'autor' => $this->faker->name(), 
            'anio_publicacion' => $this->faker->numberBetween(1900, 2024), 
            'categoria' => $this->faker->word(), 
            'disponible' => $this->faker->boolean(), 
        ];
    }
}