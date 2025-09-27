<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PropertyPurpose extends Model
{
    protected $table = 'property_purposes';

    protected $fillable = [
        'name',
        'slug_text',
    ];

    // Relationships
    public function properties(): HasMany|PropertyPurpose
    {
        return $this->hasMany(Property::class);
    }
}
