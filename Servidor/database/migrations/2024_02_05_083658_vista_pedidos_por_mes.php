<?php

use Illuminate\Database\Migrations\Migration;
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
        CREATE OR REPLACE VIEW VistaPedidosPorMes AS
        SELECT
            MONTHNAME(created_at) AS mes,
            COUNT(id) AS cantidad_pedidos
        FROM
            pedidos
        GROUP BY
            mes
    ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS VistaPedidosPorMes');
    }
};
