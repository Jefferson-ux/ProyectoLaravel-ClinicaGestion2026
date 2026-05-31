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
            $table->integer('id', true);
            $table->integer('id_cita')->index('fk_pago_cita');
            $table->decimal('monto', 10)->nullable();
            $table->date('fecha_pago')->nullable();
            $table->string('metodo_pago', 50)->nullable();
            $table->string('estado', 20)->nullable()->default('PAGADO');
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
