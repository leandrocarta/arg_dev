<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViajesTable extends Migration
{
    
    public function up(): void
    {
        Schema::create('viajes', function (Blueprint $table) {
             $table->id();
            $table->integer('adultos');
            $table->integer('menores');
            $table->string('nombre');
            $table->string('email');
            $table->text('consulta')->nullable();
            $table->timestamps();
        });
    }    
    public function down(): void
    {
        Schema::dropIfExists('viajes');
    }
};
