<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Mostrar el listado de libros con el filtro de categoría
    public function index(Request $request)
    {
        $query = Book::query();

        if ($request->filled('categoria')) {
            $query->where('categoria', $request->categoria);
        }

        $books = $query->get();
        $categorias = Book::select('categoria')->distinct()->pluck('categoria');

        return view('books.index', compact('books', 'categorias'));
    }

    // Mostrar el formulario para crear un libro
    public function create()
    {
        return view('books.create');
    }

    // Guardar el nuevo libro en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'anio_publicacion' => 'required|integer',
            'categoria' => 'required|string|max:255',
        ]);

        $data = $request->all();
        $data['disponible'] = $request->has('disponible');

        Book::create($data);

        return redirect()->route('books.index');
    }

    // Mostrar los detalles de un libro concreto
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    // Mostrar el formulario para editar un libro
    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    // Guardar los cambios del libro editado
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'anio_publicacion' => 'required|integer',
            'categoria' => 'required|string|max:255',
        ]);

        $data = $request->all();
        $data['disponible'] = $request->has('disponible');

        $book->update($data);

        return redirect()->route('books.index');
    }

    // Eliminar un libro
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index');
    }
}