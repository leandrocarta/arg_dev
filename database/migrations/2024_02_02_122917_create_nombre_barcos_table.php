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
        Schema::create('nombre_barcos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_naviera');
            $table->string('nombre');
            
            $table->foreign('id_naviera')->references('id')->on('navieras')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nombre_barcos');
    }
};
