<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    protected $fillable = [
        "fecha",
        "estado",
        "cliente_id"
    ];

    //Asocia Pedidos con Clientes.
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    //Asocia Pedidos con PedidosFormatosProductos.
    public function pedidoformatoproducto()
    {
        return $this->hasMany(PedidoFormatoProducto::class, "pedido_id");
    }
}
