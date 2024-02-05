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

    //Asocia FormatoProductosImagenes con los FormatosProductos.
    public function formatoproducto()
    {
        return $this->belongsTo(FormatoProducto::class);
    }
}
