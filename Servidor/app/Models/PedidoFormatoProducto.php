<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoFormatoProducto extends Model
{
    use HasFactory;
    protected $fillable = [
        "pedido_id",
        'formato_producto_id',
        "cantidad"
    ];

    //Asocia PedidoFormatoProducto con Pedidos.
    public function pedido()
    {
        return $this->belongsTo(Pedido::class, "id");
    }

    //Asocia PedidoFormatoProducto con FormatoProductos.
    public function formatoproducto()
    {
        return $this->belongsTo(FormatoProducto::class, 'formato_producto_id');
    }
}
