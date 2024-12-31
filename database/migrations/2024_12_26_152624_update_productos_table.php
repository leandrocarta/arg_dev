<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('productos', function (Blueprint $table) {
        $table->unsignedBigInteger('id_aerolinea')->nullable()->after('id_pais'); // Campo para la relación
        $table->foreign('id_aerolinea')->references('id')->on('aerolinea')->onDelete('cascade'); // Clave foránea
    });
}

public function down()
{
    Schema::table('productos', function (Blueprint $table) {
        $table->dropForeign(['id_aerolinea']); // Eliminar la clave foránea
        $table->dropColumn('id_aerolinea');    // Eliminar el campo
    });
}

};