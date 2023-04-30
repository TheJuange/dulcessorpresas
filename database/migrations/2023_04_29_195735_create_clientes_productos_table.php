<?php

use App\Models\productos;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clientes_productos', function (Blueprint $table) {
            $table->id();
            $table->string('fecha_entrega');
            $table->string('direccion');
            $table->string('entregar_a_nombre')->nullable();
            $table->string('contenido_extra')->nullable();
            $table->string('precio_total')->nullable();
            $table->unsignedBigInteger('producto_id')->refereces('id')->on('productos')->onDelete('cascade');
            $table->unsignedBigInteger('cliente_id')->refereces('id')->on('clientes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes_productos');
    }
};
