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
        Schema::create('citas', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('id_paciente')->index('fk_cita_paciente');
            $table->integer('id_doctor')->index('fk_cita_doctor');
            $table->date('fecha');
            $table->time('hora');
            $table->string('motivo')->nullable();
            $table->string('estado', 20)->nullable()->default('PENDIENTE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
