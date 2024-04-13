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
        Schema::create('excursiones_arg', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('detalle');
            $table->string('img')->nullable();
            $table->decimal('precio', 10, 2)->nullable();
            $table->string('video')->nullable();
            $table->string('duracion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('excursiones_arg');
    }
};
