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
    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    public function formatoproducto()
    {
        return $this->hasMany(FormatoProducto::class, "id");
    }
}
