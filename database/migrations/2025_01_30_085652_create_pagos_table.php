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
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('client_id'); // Relación con clientes (int(10))
            $table->unsignedInteger('mis_viajes_id'); // Relación con mis_viajes (int(10))
            $table->decimal('total_viaje', 10, 2); // Monto total del viaje
            $table->decimal('monto_pagado', 10, 2); // Monto del pago realizado
            $table->enum('tipo_pago', ['reserva', 'cuota'])->default('cuota'); // Tipo de pago
            $table->integer('numero_cuota')->nullable(); // Número de cuota
            $table->date('fecha_pago'); // Fecha del pago
            $table->string('metodo_pago')->nullable(); // Método de pago (Tarjeta, Transferencia, etc.)
            $table->string('comprobante')->nullable(); // Comprobante del pago (opcional)
            $table->enum('estado', ['pendiente', 'confirmado', 'rechazado'])->default('pendiente'); // Estado del pago
            $table->decimal('saldo_pendiente', 10, 2)->default(0); // Saldo restante
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};