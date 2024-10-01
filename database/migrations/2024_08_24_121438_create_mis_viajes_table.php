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
            $table->id();
            $table->string('destino');
            $table->string('mes');
            $table->integer('adultos');
            $table->integer('menores')->nullable();
            $table->integer('habitaciones');
            $table->decimal('precio', 15, 2)->nullable();
            $table->text('comentario')->nullable();
            $table->timestamps();
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
