<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PropertyType extends Model
{
    protected $table = 'property_types';

    protected $fillable = [
        'name',
    ];

    // Relationships
    public function properties(): PropertyType|HasMany
    {
        return $this->hasMany(Property::class);
    }
}
