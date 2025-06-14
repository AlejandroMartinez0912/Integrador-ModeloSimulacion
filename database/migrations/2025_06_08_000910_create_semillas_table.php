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
        Schema::create('semillas', function (Blueprint $table) {
            $table->id();
            $table->integer('v1');
            $table->integer('v2');
            $table->integer('c');
            $table->integer('m');
            $table->integer('cantidad');
            $table->string('test')->default('pendiente'); // Estado del test de Chi Cuadrado
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('semillas');
    }
};
