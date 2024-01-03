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
        Schema::create('viaje_a_medida', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('email');
            $table->date('fecha');
            $table->integer('dias');
            $table->string('destino');
            $table->integer('adultos');
            $table->integer('menores');
            $table->string('presupuesto');
            $table->string('hotel');
            $table->text('actividades');
            $table->text('salud');
            $table->text('itinerario');
            $table->text('expectativa');
            $table->text('otro');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('viaje_a_medida');
    }
};
