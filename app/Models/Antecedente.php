<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Antecedente extends Model
{
    /** @use HasFactory<\Database\Factories\AntecedenteFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'paciente_id',
        'tipo_antecedente_id',
        'descripcion',
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function tipoAntecedente()
    {
        return $this->belongsTo(TipoAntecedente::class);
    }

    public function getCreatedAtAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['created_at'])->format('Y-m-d h:m:s');
    }

    public function getUpdatedAtAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['updated_at'])->format('Y-m-d h:m:s');
    }
}
