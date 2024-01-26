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
        Schema::create('formato_producto_imagens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('formato_producto_id');
            $table->timestamps();

            $table->foreign('formato_producto_id')->references('id')->on('formato_productos')->onDelete('cascade');
        });
        DB::statement("ALTER TABLE formato_producto_imagens ADD imagen LONGBLOB");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formato_producto_imagens');
    }
};
