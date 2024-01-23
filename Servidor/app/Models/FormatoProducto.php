<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormatoProducto extends Model
{
    use HasFactory;
    public function imagenes()
    {
        return $this->hasMany(FormatoProductoImagen::class, 'formato_producto_id');
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