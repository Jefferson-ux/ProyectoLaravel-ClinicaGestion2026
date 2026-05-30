<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cita extends Model
{
    protected $table = 'citas';

    protected $fillable = [
        'id_paciente',
        'id_doctor',
        'fecha',
        'hora',
        'motivo',
        'estado',
    ];

    public function paciente(): BelongsTo
    {
        return $this->belongsTo(Paciente::class, 'id_paciente');
    }

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class, 'id_doctor');
    }

    public function recetas(): HasMany
    {
        return $this->hasMany(Receta::class, 'id_cita');
    }

    public function pagos(): HasMany
    {
        return $this->hasMany(Pago::class, 'id_cita');
    }
}
