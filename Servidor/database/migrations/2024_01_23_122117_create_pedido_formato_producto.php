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
        Schema::create('pedido_formato_producto', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("formato_producto_id");
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
