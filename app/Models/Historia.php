<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Historia extends Model
{
    /** @use HasFactory<\Database\Factories\HistoriaFactory> */
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;

    protected $fillable = [
        'id'
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
