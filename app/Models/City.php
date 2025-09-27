<?php

namespace App\Models;

use App\Data\CityData;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\LaravelData\WithData;

class City extends Model
{
    use WithData;

    protected $table = 'cities';

    protected string $dataClass = CityData::class;

    protected $fillable = [
        'name', 'province_id',
    ];

    // Relationships
    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    public function neighborhoods(): HasMany|City
    {
        return $this->hasMany(Neighborhood::class);
    }


}
