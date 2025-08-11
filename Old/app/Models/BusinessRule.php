<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessRule extends Model
{

    protected $table = 'business_rules';

    protected $fillable = [
        'name',
    ];

    // Relationships
    public function properties()
    {
        return $this->hasMany(Property::class);
    }
}
