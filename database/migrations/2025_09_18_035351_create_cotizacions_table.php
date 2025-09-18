<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cotizaciones', function (Blueprint $table) {
            $table->id();
            $table->string('tipo'); // 'oficial', 'blue', etc.
            $table->decimal('compra', 10, 2)->nullable();
            $table->decimal('venta', 10, 2)->nullable();
            $table->date('fecha');
            $table->timestamps();

            // Para no guardar la misma cotización para el mismo día dos veces.
            $table->unique(['fecha', 'tipo']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cotizaciones');
    }
};