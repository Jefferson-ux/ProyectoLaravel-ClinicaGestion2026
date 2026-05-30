<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Doctor extends Model
{
    protected $table = 'doctores';

    protected $fillable = [
        'dni',
        'nombres',
        'apellidos',
        'telefono',
        'correo',
        'id_especialidad',
        'estado',
    ];

    public function especialidad(): BelongsTo
    {
        return $this->belongsTo(Especialidad::class, 'id_especialidad');
    }

    public function citas(): HasMany
    {
        return $this->hasMany(Cita::class, 'id_doctor');
    }
}
