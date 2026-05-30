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
        Schema::create('doctores', function (Blueprint $table) {
            $table->integer('id', true);
            $table->char('dni', 8)->unique('dni');
            $table->string('nombres', 100);
            $table->string('apellidos', 100);
            $table->string('telefono', 15)->nullable();
            $table->string('correo', 100)->nullable()->unique('correo');
            $table->integer('id_especialidad')->nullable()->index('fk_doctor_especialidad');
            $table->tinyInteger('estado')->nullable()->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctores');
    }
};
