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
        Schema::create('informacion_graduando', function (Blueprint $table) {
            $table->id(); 
            $table->string('cedula')->nullable(); 
            $table->string('nombres')->nullable();
            $table->string('apellidos')->nullable();
            $table->string('titulo')->nullable();
            $table->string('nombre invitados')->nullable();
            $table->string('id_qr');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informacion_graduando');
    }
};
