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
        Schema::create('itinerario_cupos', function (Blueprint $table) {
        $table->id(); 
        $table->unsignedBigInteger('aereos_id'); 
        $table->string('origen', 255); 
        $table->string('destino', 255); 
        $table->time('hora_salida'); 
        $table->time('hora_llegada'); 
        $table->date('fecha_salida'); 
        $table->date('fecha_llegada'); 
        $table->integer('cupos'); 
        $table->timestamps(); 

        // Clave foránea
        $table->foreign('aereos_id')->references('id')->on('aereos')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itinerario_cupos');
    }
};