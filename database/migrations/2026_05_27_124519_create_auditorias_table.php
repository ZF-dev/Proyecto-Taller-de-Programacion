<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('auditorias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('accion');   // Modificacion-Stock, etc
            $table->string('tabla_afectada');  // user, ventas, motos
            $table->json('detalles');   // los detalles del Jason
            $table->ipAddress('ip_address')->nullable();  // ip del culpable
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('auditorias');
    }
};
