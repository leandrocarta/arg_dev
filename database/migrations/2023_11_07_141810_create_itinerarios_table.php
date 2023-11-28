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
        Schema::create('itinerarios', function (Blueprint $table) {
            $table->id();
            $table->string('cod_producto');
            $table->string('dia1');
            $table->string('dia2');
            $table->string('dia3');
            $table->string('dia4');
            $table->string('dia5');
            $table->string('dia6');
            $table->string('dia7');
            $table->string('dia8');
            $table->string('dia9');
            $table->string('dia10');
            $table->string('dia11');
            $table->string('dia12');
            $table->string('dia13');
            $table->string('dia14');
            $table->string('dia15');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itinerarios');
    }
};
