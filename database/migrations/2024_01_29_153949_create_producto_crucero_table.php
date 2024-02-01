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
        Schema::create('producto_crucero', function (Blueprint $table) {
           $table->id();
            $table->string('destino')->nullable();
            $table->date('fecha_partida')->nullable();
            $table->integer('estadia')->nullable();
            $table->string('puerto_salida')->nullable();
            $table->string('naviera')->nullable();
            $table->string('nombre_barco')->nullable();
            $table->string('tipo_cabina')->nullable();
            $table->text('detalle')->nullable()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('producto_crucero');
    }
};
