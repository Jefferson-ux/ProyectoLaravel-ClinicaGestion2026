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
        Schema::table('citas', function (Blueprint $table) {
            $table->foreign(['id_doctor'], 'fk_cita_doctor')->references(['id'])->on('doctores')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['id_paciente'], 'fk_cita_paciente')->references(['id'])->on('pacientes')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('citas', function (Blueprint $table) {
            $table->dropForeign('fk_cita_doctor');
            $table->dropForeign('fk_cita_paciente');
        });
    }
};
