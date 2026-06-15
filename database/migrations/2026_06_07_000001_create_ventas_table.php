<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->decimal('total', 12, 2);
            
            // Métodos de pago flexibles: 'tarjeta', 'transferencia', 'efectivo'
            $table->string('metodo_pago'); 
            
            // Campos opcionales (nullable) según el método elegido
            $table->string('comprobante_transferencia')->nullable(); // Para CBU/Alias
            $table->string('tarjeta_ultimos_cuatro')->nullable();    // Por seguridad solo 4 dígitos
            $table->string('titular_pago')->nullable();              // Nombre del titular o quien transfiere
            $table->integer('dni_pagador')->nullable();              // DNI para facturación
            
            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};

