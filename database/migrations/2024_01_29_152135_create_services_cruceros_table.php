<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{   
    public function up(): void
    {
        Schema::create('services_cruceros', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_prod')->nullable();
            $table->string('traslados_orig')->nullable();
            $table->string('traslados_dest')->nullable();
            $table->string('comidas')->nullable();
            $table->string('seguro')->nullable();
            $table->string('propinas')->nullable();
            $table->string('wifi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services_cruceros');
    }
};
