<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proveedores_mayoristas', function (Blueprint $table) {
             $table->id();
             $table->string('nombre');
             $table->string('direccion');
             $table->string('localidad');
             $table->string('provincia');
             $table->string('telefono');
             $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proveedores_mayoristas');
    }
};
