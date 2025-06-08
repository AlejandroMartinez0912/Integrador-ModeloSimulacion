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
        Schema::create('numeros', function (Blueprint $table) {
            $table->id();
            $table->double('resultados');
            $table->foreignId('semilla_id')->constrained()->onDelete('cascade');
            $table->string('test')->nullable(); // Esta columna es opcional, puede ser nula. (Vamos a usarla para el test de Chi-Cuadrado)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('numeros');
    }
};
