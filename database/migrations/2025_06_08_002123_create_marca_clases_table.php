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
        Schema::create('marca_clases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('semilla_id')->constrained()->onDelete('cascade'); // referencia al conjunto de números
            $table->integer('clase');
            $table->double('limite_inferior');
            $table->double('limite_superior');
            $table->double('marca_clase'); // (LI + LS) / 2
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marca_clases');
    }
};
