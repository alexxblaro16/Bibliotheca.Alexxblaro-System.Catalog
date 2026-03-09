<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Mostrar el listado de libros con filtro de categoría y limpieza de duplicados.
     */
    public function index(Request $request)
    {
        $query = Book::query();

        // Aplicar filtro por categoría si existe en la URL
        if ($request->filled('categoria')) {
            $query->where('categoria', $request->categoria);
        }

        // 1. Obtenemos todos los libros de la consulta
        // 2. Usamos unique() sobre la colección para filtrar por título normalizado
        $books = $query->get()->unique(function ($item) {
            return strtolower(trim($item->titulo));
        });

        // Obtener categorías únicas para el selector del menú superior
        $categorias = Book::select('categoria')
            ->distinct()
            ->orderBy('categoria', 'asc')
            ->pluck('categoria');

        return view('books.index', compact('books', 'categorias'));
    }

    /**
     * Mostrar el formulario para crear un nuevo registro.
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Guardar el nuevo libro validando que no sea un duplicado manual.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'anio_publicacion' => 'required|integer|min:1000|max:' . date('Y'),
            'categoria' => 'required|string|max:255',
        ]);

        $data = $request->all();
        // Convertir el checkbox a booleano para la base de datos
        $data['disponible'] = $request->has('disponible');

        Book::create($data);

        return redirect()->route('books.index')->with('success', 'Registro creado correctamente.');
    }

    /**
     * Mostrar los detalles de un libro (Vista individual).
     */
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    /**
     * Mostrar el formulario de edición.
     */
    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    /**
     * Actualizar los datos de un libro existente.
     */
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

        return redirect()->route('books.index')->with('success', 'Registro actualizado.');
    }

    /**
     * Eliminar físicamente un registro de la base de datos.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Registro eliminado del sistema.');
    }
}