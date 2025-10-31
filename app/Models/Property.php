<?php

namespace App\Models;

use App\Data\PropertyData;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\LaravelData\WithData;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Property extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, WithData;

    protected $table = 'properties';

    protected string $dataClass = PropertyData::class;

    protected $fillable = [
        'title',
        'description',
        'bathrooms',
        'price',
        'year',
        'floors',
        'area',
        'bedrooms',
        'suites',
        'garages',
        'pools',
        'address',
        'map',
        'published_at',
        'views',
        'neighborhood_id',
        'condition_id',
        'property_type_id',
        'status_id',
        'broker_id',
        'slug',
        'for_rent',
        'property_purpose_id',
        'business_rule_id',
        'intermediation_rule_id',
        'details',
        'approved',
        'approved_by_id',
        'approved_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'approved_at' => 'datetime',
        'for_rent' => 'boolean',
        'approved' => 'boolean',
        'price' => 'string',
        'area' => 'string',
    ];

    // Relationships
    public function neighborhood(): BelongsTo
    {
        return $this->belongsTo(Neighborhood::class);
    }

    public function condition(): BelongsTo
    {
        return $this->belongsTo(Condition::class);
    }

    public function propertyType(): BelongsTo
    {
        return $this->belongsTo(PropertyType::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function broker(): BelongsTo
    {
        return $this->belongsTo(User::class, 'broker_id');
    }

    public function propertyPurpose(): BelongsTo
    {
        return $this->belongsTo(PropertyPurpose::class);
    }

    public function businessRule(): BelongsTo
    {
        return $this->belongsTo(BusinessRule::class);
    }

    public function intermediationRule(): BelongsTo
    {
        return $this->belongsTo(IntermediationRule::class);
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by_id');
    }

    public function comments(): HasMany|Property
    {
        return $this->hasMany(Comment::class);
    }

    public function ratings(): HasMany|Property
    {
        return $this->hasMany(Rating::class);
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')->width('300')->height('200')->nonQueued();
        $this->addMediaConversion('large')->width('800')->height('600')->nonQueued();
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images')->withResponsiveImages();
    }
}
