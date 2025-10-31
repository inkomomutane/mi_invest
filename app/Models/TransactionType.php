<?php

namespace App\Models;

use Database\Factories\TransactionTypeFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class TransactionType extends Model implements HasMedia
{
    /** @use HasFactory<TransactionTypeFactory> */
    use HasFactory;
    use InteractsWithMedia;

    protected $table = 'transaction_types';

    protected $fillable = [
        'name',
        'prefix'
    ];

    // Relationships
    public function properties(): PropertyType|HasMany
    {
        return $this->hasMany(Property::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('icons')->withResponsiveImages()->singleFile();
    }
}
