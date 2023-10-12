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
        Schema::create('clients_reclamos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_client');
            $table->string('name');
            $table->string('lastname')->nullable();
            $table->string('email');
            $table->string('cod_pais');
            $table->string('tel');
            $table->string('pais');
            $table->longText('detalle');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients_reclamos');
    }
};
