<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rating extends Model
{
    use HasFactory;

    protected $table = 'ratings';

    protected $casts = [
        'rating' => 'decimal:2',
        'property_id' => 'int',
    ];

    protected $fillable = [
        'rating',
        'ip',
        'name',
        'property_id',
    ];

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
}
