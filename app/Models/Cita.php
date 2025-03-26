<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Cita extends Model
{
    /** @use HasFactory<\Database\Factories\CitaFactory> */
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;

    protected $fillable = [
        'paciente_id',
        'doctor_id',
        'producto_id',
        'tipo_cita_id',
        'title',
        'start',
        'end',
        'startTime',
        'endTime',
        'color',
        'backgroundColor',
        'borderColor',
        'textColor',
        'allday'
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
