<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    use HasFactory;

    // Ajustado para usar IDs de relación en lugar de texto plano
    protected $fillable = [
        'titulo', 
        'author_id', 
        'category_id', 
        'anio_publicacion', 
        'stock', 
        'disponible'
    ];

    // Relación: Un libro pertenece a un autor
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    // Relación: Un libro pertenece a una categoría
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // Relación: Un libro puede ser prestado a muchos usuarios
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
                    ->withPivot('reserved_at', 'status')
                    ->withTimestamps();
    }
}