<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BorrowBookController extends Controller
{
    /**
     * Registra el préstamo de un libro (Misión: Reserva de ejemplar)
     */
    public function store(Request $request, $user_id, $book_id)
    {
        // 1. Localizar los datos en la red (Base de Datos)
        $user = User::findOrFail($user_id);
        $book = Book::findOrFail($book_id);

        // 2. Lógica Anti-Duplicados: Verificar si ya tiene este libro activo
        if ($user->books()->where('book_id', $book_id)->whereNull('returned_at')->exists()) {
            return redirect()->back()->with('error', 'Acceso denegado: El ejemplar ya está en tu inventario.');
        }

        // 3. Ejecutar vinculación en la tabla pivote
        // Nota: Asegúrate de tener 'reserved_at' en tu migración de la tabla intermedia
        $user->books()->attach($book->id, [
            'reserved_at' => now(),
            'status' => 'active' 
        ]);

        return redirect()->route('books.index')
            ->with('status', "Protocolo aceptado: {$book->title} ha sido vinculado a {$user->name}.");
    }

    /**
     * Listado de libros vinculados al usuario (Terminal View)
     */
    public function index($user_id)
    {
        $user = User::with('books')->findOrFail($user_id);

        // En lugar de usar 'echo', enviamos los datos a una vista Cyberpunk
        return view('books.user_inventory', [
            'user' => $user,
            'books' => $user->books
        ]);
    }
}