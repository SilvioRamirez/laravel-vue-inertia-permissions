<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Doctor extends Model
{
    /** @use HasFactory<\Database\Factories\DoctorFactory> */
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;

    protected $fillable = [
        'nombre',
        'cedula',
        'rif',
        'telefono_celular',
        'telefono_fijo',
        'correo',
        'logo_path',
        'direccion',
        'ciudad',
        'estado',
        'titulo',
        'dr_titulo',
        'mpps',
        'cmt'
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
