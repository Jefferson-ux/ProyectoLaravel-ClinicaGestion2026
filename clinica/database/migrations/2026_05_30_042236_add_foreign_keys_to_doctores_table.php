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
        Schema::table('doctores', function (Blueprint $table) {
            $table->foreign(['id_especialidad'], 'fk_doctor_especialidad')->references(['id'])->on('especialidades')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('doctores', function (Blueprint $table) {
            $table->dropForeign('fk_doctor_especialidad');
        });
    }
};
