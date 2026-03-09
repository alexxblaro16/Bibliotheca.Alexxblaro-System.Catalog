<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // <-- Esta línea arriba

class Book extends Model
{
    use HasFactory;     

    protected $fillable = ['titulo', 'autor', 'anio_publicacion', 'categoria', 'disponible'];
}