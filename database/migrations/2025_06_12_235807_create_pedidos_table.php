<?php

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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('semilla_id')->constrained('semillas');
            $table->integer('num_dia')->default(0);
            $table->float('cantidad_solicitada')->default(0);
            $table->float('cantidad_recibida')->default(0);
            $table->enum('estado', ['pendiente', 'satisfecha', 'insatisfecha'])->default('pendiente');
            $table->integer('demora')->default(0); // Días de demora
            $table->date('fecha')->nullable(); // Fecha del pedido
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
