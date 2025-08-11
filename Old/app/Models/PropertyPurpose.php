<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyPurpose extends Model
{
    use HasFactory;

    protected $table = 'property_purposes';

    protected $fillable = [
        'name',
        'slug_text',
    ];

    // Relationships
    public function properties()
    {
        return $this->hasMany(Property::class);
    }
}
