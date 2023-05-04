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
        Schema::create('token_qr', function (Blueprint $table) {
            $table->string('token')->primary(); // Crea la columna 'token' como clave primaria
            $table->integer('numero_entradas');// se crea para saber cuantas entradas por qr se van a tener 
            $table->string('nombe_grupo'); // esto lo hacemos parea identifar los grupos de qr 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('token_qr');
    }
};
