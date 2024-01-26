<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormatoProductoImagen extends Model
{
    use HasFactory;
    protected $fillable = [
        "imagen",
        "formato_producto_id"
    ];
    public function formatoProducto()
    {
        return $this->belongsTo(FormatoProducto::class, 'formato_producto_id');
    }
}
