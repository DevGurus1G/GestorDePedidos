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

    //Asocia FormatoProducto con las Imagenes.
    public function imagenes()
    {
        return $this->hasMany(FormatoProductoImagen::class, 'formato_producto_id');
    }

    //Asocia FormatoProductos con los Productos.
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    //Asocia FormatoProductos con los Formatos.
    public function formato()
    {
        return $this->belongsTo(Formato::class, 'formato_id');
    }

    //Asocia Formatoproductois con los Pedidos.
    public function pedidos()
    {
        return $this->belongsToMany(PedidoFormatoProducto::class, 'pedido_formato_producto', 'formato_producto_id', 'pedido_id');
    }
}
