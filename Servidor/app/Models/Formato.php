<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formato extends Model
{
    use HasFactory;
    protected $fillable = [
        "tipo"
    ];

    //Asocia los Formatos con los Productos.
    public function productos()
    {
        return $this->belongsToMany(Producto::class)->withPivot('precio', 'disponibilidad')->withTimestamps();
    }
}
