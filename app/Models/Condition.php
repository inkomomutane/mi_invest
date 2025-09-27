<?php

namespace App\Models;

use App\Data\ConditionData;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\LaravelData\WithData;

class Condition extends Model
{

    use WithData;

    protected $table = 'conditions';

    protected string  $dataClass = ConditionData::class;

    protected $fillable = [
        'name',
    ];

    // Relationships
    public function properties(): Condition|HasMany
    {
        return $this->hasMany(Property::class);
    }
}
