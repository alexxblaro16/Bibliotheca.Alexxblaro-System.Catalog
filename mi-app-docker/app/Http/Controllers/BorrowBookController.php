<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use Illuminate\Http\Request;

class BorrowBookController extends Controller
{
    /**
     * Registra la reserva de un ejemplar en la tabla pivote.
     */
    public function store(Request $request, $user_id, $book_id)
    {
        $user = User::findOrFail($user_id);
        $book = Book::findOrFail($book_id);

        // Verificación de integridad: ¿Hay stock físico?
        if ($book->stock <= 0) {
            return back()->with('error', 'Error: No hay ejemplares disponibles en la red.');
        }

        // Registro en la tabla book_user
        $user->books()->attach($book->id, [
            'status' => 'active',
            'reserved_at' => now()
        ]);

        // Actualización de inventario
        $book->decrement('stock');

        return redirect()->route('books.index')->with('success', 'Protocolo de reserva completado con éxito.');
    }

    /**
     * Muestra los libros reservados por el usuario.
     */
    public function inventory($user_id)
    {
        $user = User::with('books')->findOrFail($user_id);
        return view('borrow.inventory', compact('user'));
    }
}