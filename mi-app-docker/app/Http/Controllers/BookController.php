<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Muestra el catálogo principal con filtros de categoría.
     */
    public function index(Request $request)
    {
        $query = Book::with(['author', 'category']);

        // Filtro por categoría si se recibe en la URL
        if ($request->has('categoria') && $request->categoria != '') {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('name', $request->categoria);
            });
        }

        $books = $query->get();
        $categorias = Category::pluck('name');

        return view('books.index', compact('books', 'categorias'));
    }

    /**
     * Muestra la ficha detallada de un libro.
     */
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    /**
     * Formulario para crear un nuevo registro.
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Formulario para editar un registro existente.
     */
    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }
}