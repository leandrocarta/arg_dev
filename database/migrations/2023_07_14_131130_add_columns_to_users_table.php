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
        Schema::table('users', function (Blueprint $table) {
            $table->string('nombre')->nullable()->after('password');
            $table->string('apellido')->nullable();
            $table->string('dni_select')->nullable();
            $table->string('dni_num')->nullable();
            $table->string('direccion')->nullable();
            $table->string('movil_area')->nullable();
            $table->string('movil_num')->nullable();
            $table->string('rango')->nullable();
            $table->string('link')->nullable();
            $table->string('habilitado')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
