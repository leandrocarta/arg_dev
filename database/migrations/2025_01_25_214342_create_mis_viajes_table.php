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
            Schema::create('mis_viajes', function (Blueprint $table) {
             $table->id(); // Clave primaria
             $table->unsignedInteger('client_id'); // Cambiado a unsignedInteger para coincidir con clients.id
             $table->unsignedBigInteger('destino_id'); // Relación con destinos
             $table->unsignedBigInteger('hotel_id'); // Relación con hotels
             $table->date('fecha_inicio')->nullable(); // Fecha de inicio del viaje
             $table->date('fecha_fin')->nullable(); // Fecha de fin del viaje
             $table->string('estado')->default('pendiente'); // Estado del viaje
             $table->text('notas')->nullable(); // Notas adicionales
             $table->timestamps(); // created_at y updated_at

             // Definición de claves foráneas
             $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
             $table->foreign('destino_id')->references('id')->on('destinos')->onDelete('cascade');
             $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mis_viajes');
    }
};