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
        Schema::create('aerolinea', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100); // Nombre de la compañía
            $table->string('descripcion', 255)->nullable(); // Descripción asociada
            $table->date('fecha_inicio')->nullable(); // Fecha de inicio
            $table->date('fecha_fin')->nullable(); // Fecha de fin
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aerolinea');
    }
};