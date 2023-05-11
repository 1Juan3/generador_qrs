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
        Schema::create('registro_entrada', function (Blueprint $table) {
            $table->id(); 
            $table->string('id_qr'); // Se necesita el token del qr para generar un registro de cada vez que este se escanea 
            $table->string('comentario')->nullable();// por si se deja alguna observacion
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registro_entrada');
    }
};
