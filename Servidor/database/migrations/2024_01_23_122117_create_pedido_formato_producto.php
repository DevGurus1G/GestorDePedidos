<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pedido_formato_productos', function (Blueprint $table) {
            $table->id();
            $table->integer("cantidad");
            $table->unsignedBigInteger("formato_producto_id");
            $table->unsignedBigInteger("pedido_id");
            $table->foreign("pedido_id")->references("id")->on("pedidos")->onDelete("cascade");
            $table->foreign("formato_producto_id")->references("id")->on("formato_productos")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedido_formato_productos');
    }
};
