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
        Schema::create('demandas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('semilla_id')->constrained('semillas');
            $table->foreignId('stock_id')->constrained('stocks');
            $table->integer('num_dia')->default(0);
            $table->float('cantidad_solicitada')->default(0);
            $table->float('cantidad_cubierta')->default(0);
            $table->enum('estado', ['satisfecha', 'insatisfecha', 'pendiente'])->default('pendiente'); 
            $table->date('fecha')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demandas');
    }
};
