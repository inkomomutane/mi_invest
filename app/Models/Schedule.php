<?php

namespace App\Models;

use App\Data\ScheduleData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\LaravelData\WithData;

class Schedule extends Model
{
    use HasFactory;
    use WithData;

    protected $table = 'schedules';

    protected string $dataClass = ScheduleData::class;

    protected $appends = ['url'];

    protected $casts = [
        'broker_id' => 'int',
        'property_id' => 'int',
        'scheduled_at' => 'datetime',
        'is_read' => 'boolean',
    ];

    protected $fillable = [
        'client_name',
        'message',
        'email',
        'contact',
        'scheduled_at',
        'broker_id',
        'property_id',
        'is_read',
    ];

    public function getUrlAttribute()
    {
        return $this->property?->slug ?? '';
    }

    public function broker(): BelongsTo
    {
        return $this->belongsTo(User::class, 'broker_id');
    }

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class, 'property_id');
    }
}
