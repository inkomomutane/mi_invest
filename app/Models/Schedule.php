<?php

namespace App\Models;

use App\Data\ScheduleData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\WithData;

class Schedule extends Model
{
    use HasFactory;
    use WithData;

    protected $table = 'schedules';

    protected $dataClass = ScheduleData::class;

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

    public function broker()
    {
        return $this->belongsTo(User::class, 'broker_id');
    }

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }
}
