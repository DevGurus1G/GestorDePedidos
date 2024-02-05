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
        CREATE OR REPLACE VIEW VistaIngresosPorMes AS
        SELECT
            MONTHNAME(pf.created_at) AS mes,
            SUM(fp.precio * pf.cantidad) AS ingresos
        FROM
            pedido_formato_productos pf
        JOIN
            formato_productos fp ON pf.formato_producto_id = fp.id
        GROUP BY
            mes
    ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS VistaIngresosPorMes');
    }
};
