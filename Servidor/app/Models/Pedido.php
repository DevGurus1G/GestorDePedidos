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

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function formatoproducto()
    {
        return $this->hasMany(FormatoProducto::class);
    }

    public function pedidoformatoproducto()
    {
        return $this->hasMany(PedidoFormatoProducto::class);
    }
}
