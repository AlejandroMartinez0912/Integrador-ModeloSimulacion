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
        Schema::create('movimientos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('venta_id')->nullable()->constrained('ventas');
            $table->foreignId('pedido_id')->nullable()->constrained('pedidos');
            $table->foreignId('stock_id')->constrained('stocks');
            $table->enum('tipo', ['ingreso_inicial','ingreso', 'egreso'])->default('ingreso_inicial'); // Ingreso inicial, Ingreso, Egreso
            $table->float('cantidad')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimientos');
    }
};
