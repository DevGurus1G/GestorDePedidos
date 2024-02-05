<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $fillable = [
        "nombre"
    ];

    //Asocia Producto con Categrías.
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    //Asocia Producto con Formatos.
    public function formatos()
    {
        return $this->belongsToMany(Formato::class)->withPivot('precio', 'disponibilidad')->withTimestamps();
    }
}
