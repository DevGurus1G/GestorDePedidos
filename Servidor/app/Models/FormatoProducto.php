<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormatoProducto extends Model
{
    use HasFactory;
    protected $fillable = [
        "producto_id",
        "formato_id",
        "precio",
        "disponibilidad"
    ];
    public function imagenes()
    {
        return $this->hasMany(FormatoProductoImagen::class, 'formato_producto_id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }

    public function formato()
    {
        return $this->belongsTo(Formato::class, 'formato_id');
    }
}


// Para cuando haya que agregar

// $producto = Producto::find(1);
// $formato = Formato::find(1);

// $imagenesPaths = ['ruta/del/archivo/imagen1.jpg', 'ruta/del/archivo/imagen2.jpg', 'ruta/del/archivo/imagen3.jpg'];

// $formatoProducto = $producto->formatos()->attach($formato, [
//     'precio' => 19.99,
//     'disponibilidad' => 50,
// ]);

// foreach ($imagenesPaths as $imagenPath) {
//     $formatoProducto->imagenes()->create(['imagen_path' => $imagenPath]);
// }