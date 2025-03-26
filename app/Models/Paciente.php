<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Paciente extends Model
{
    /** @use HasFactory<\Database\Factories\PacienteFactory> */
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;

    protected $fillable = [
        'user_id',
        'nombres',
        'cedula',
        'telefono_celular',
        'telefono_fijo',
        'correo',
        'direccion',
        'fecha_nacimiento',
        'edad',
        'genero',
        'ocupacion',
        'responsable',
        'grupo_sanguineo'
    ];

    /**
     * Implement Logs Activity
     *
     * @var array<int, string>
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}")
            ->dontSubmitEmptyLogs();
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
