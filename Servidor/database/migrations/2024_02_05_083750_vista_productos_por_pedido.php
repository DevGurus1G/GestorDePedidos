<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('
            CREATE OR REPLACE VIEW VistaProductosPorPedido AS
            SELECT p.nombre AS nombre_producto, f.tipo AS tipo_formato, COUNT(pf.pedido_id) AS cantidad_pedidos
            FROM pedido_formato_productos pf
            JOIN formato_productos fp ON pf.formato_producto_id = fp.id
            JOIN formatos f ON fp.formato_id = f.id
            JOIN productos p ON fp.producto_id = p.id
            GROUP BY p.nombre, f.tipo
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS VistaProductosPorPedido');
    }
};
