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
        Schema::create('itinerario_crucero', function (Blueprint $table) {
           $table->id();
            $table->string('dia1')->nullable();
            $table->string('dia2')->nullable();
            $table->string('dia3')->nullable();
            $table->string('dia4')->nullable();
            $table->string('dia5')->nullable();
            $table->string('dia6')->nullable();
            $table->string('dia7')->nullable();
            $table->string('dia8')->nullable();
            $table->string('dia9')->nullable();
            $table->string('dia10')->nullable();
            $table->string('dia11')->nullable();
            $table->string('dia12')->nullable();
            $table->string('dia13')->nullable();
            $table->string('dia14')->nullable();
            $table->string('dia15')->nullable();
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('itinerario_crucero');
    }
};
