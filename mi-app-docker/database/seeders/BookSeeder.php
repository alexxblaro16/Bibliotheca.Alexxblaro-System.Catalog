<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    public function run(): void
    {
       
        $libros = [
            ['titulo' => 'Cien años de soledad', 'autor' => 'Gabriel García Márquez', 'anio_publicacion' => 1967, 'categoria' => 'Realismo Mágico'],
            ['titulo' => '1984', 'autor' => 'George Orwell', 'anio_publicacion' => 1949, 'categoria' => 'Ciencia Ficción'],
            ['titulo' => 'El Señor de los Anillos', 'autor' => 'J.R.R. Tolkien', 'anio_publicacion' => 1954, 'categoria' => 'Fantasía'],
            ['titulo' => 'Don Quijote de la Mancha', 'autor' => 'Miguel de Cervantes', 'anio_publicacion' => 1605, 'categoria' => 'Clásicos'],
            ['titulo' => 'Dune', 'autor' => 'Frank Herbert', 'anio_publicacion' => 1965, 'categoria' => 'Ciencia Ficción'],
            ['titulo' => 'Orgullo y Prejuicio', 'autor' => 'Jane Austen', 'anio_publicacion' => 1813, 'categoria' => 'Clásicos'],
            ['titulo' => 'Fahrenheit 451', 'autor' => 'Ray Bradbury', 'anio_publicacion' => 1953, 'categoria' => 'Ciencia Ficción'],
            ['titulo' => 'El Hobbit', 'autor' => 'J.R.R. Tolkien', 'anio_publicacion' => 1937, 'categoria' => 'Fantasía'],
            ['titulo' => 'Drácula', 'autor' => 'Bram Stoker', 'anio_publicacion' => 1897, 'categoria' => 'Terror'],
            ['titulo' => 'El Código Da Vinci', 'autor' => 'Dan Brown', 'anio_publicacion' => 2003, 'categoria' => 'Misterio'],
            ['titulo' => 'Harry Potter y la piedra filosofal', 'autor' => 'J.K. Rowling', 'anio_publicacion' => 1997, 'categoria' => 'Fantasía'],
            ['titulo' => 'Fundación', 'autor' => 'Isaac Asimov', 'anio_publicacion' => 1951, 'categoria' => 'Ciencia Ficción'],
            ['titulo' => 'El resplandor', 'autor' => 'Stephen King', 'anio_publicacion' => 1977, 'categoria' => 'Terror'],
            ['titulo' => 'Los pilares de la Tierra', 'autor' => 'Ken Follett', 'anio_publicacion' => 1989, 'categoria' => 'Novela Histórica'],
            ['titulo' => 'La sombra del viento', 'autor' => 'Carlos Ruiz Zafón', 'anio_publicacion' => 2001, 'categoria' => 'Misterio'],
        ];

        
        foreach ($libros as $libro) {
            Book::factory()->create([
                'titulo' => $libro['titulo'],
                'autor' => $libro['autor'],
                'anio_publicacion' => $libro['anio_publicacion'],
                'categoria' => $libro['categoria'],
                'disponible' => (bool) rand(0, 1),
            ]);
        }

        
        Book::factory()->count(5)->create();
    }
}