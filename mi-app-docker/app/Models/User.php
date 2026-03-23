<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Book; // Importamos el modelo Book

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * RELACIÓN CRÍTICA: Libros que el usuario tiene prestados/reservados.
     * Esto habilita el sistema de inventario.
     */
    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_user')
                    ->withPivot('status', 'reserved_at')
                    ->withTimestamps();
    }
}