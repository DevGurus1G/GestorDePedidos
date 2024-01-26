<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoFormatoProducto extends Model
{
    use HasFactory;
    protected $fillable = ['formato_producto_id'];
    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }
}
