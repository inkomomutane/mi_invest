<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BusinessRule extends Model
{

    # use Searchable;

    protected $table = 'business_rules';

    protected $fillable = [
        'name',
    ];

    // Relationships
    public function properties(): BusinessRule|HasMany
    {
        return $this->hasMany(Property::class);
    }
}
