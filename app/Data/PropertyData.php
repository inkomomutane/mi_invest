<?php

namespace App\Data;

use App\Models\Property;
use Illuminate\Support\Carbon;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;

/** @typescript */
class PropertyData extends Data
{
    public function __construct(
        public Lazy|null|int       $id,
        public Lazy|null|string    $title,
        public Lazy|null|string    $description,
        public Lazy|null|string    $details,
        public Lazy|null|int       $bathrooms,
        public Lazy|null|string    $price,
        public Lazy|null|int       $year,
        public Lazy|null|int       $floors,
        public Lazy|null|string    $area,
        public Lazy|null|int       $bedrooms,
        public Lazy|null|int       $suites,
        public Lazy|null|int       $garages,
        public Lazy|null|int       $pools,
        public Lazy|null|string    $address,
        public Lazy|null|string    $map,
        public Lazy|null|int       $views,
        public string|null         $condition,
        public string|null         $neighborhood,
        public string|null         $propertyType,
        public string|null         $status,
        public string|null         $broker,
        public string|null         $slug,
        public null|bool           $forRent,
        public string|null         $businessRule,
        public string|null         $propertyPurpose,
        public string|null         $intermediationRule,
        public Lazy|null|MediaData $media,
        public Lazy|null|MediaData $images,
        public null|bool           $approved,
        public null|string|Carbon  $approvedAt,
        public string|null         $approvedBy,
    ) {
    }

    public static function fromModel(Property $property): PropertyData
    {
        return new self(
            id: $property->id,
            title: $property->title,
            description: $property->description,
            details: $property->details,
            bathrooms: $property->bathrooms,
            price: $property->price,
            year: $property->year,
            floors: $property->floors,
            area: $property->area,
            bedrooms: $property->bedrooms,
            suites: $property->suites,
            garages: $property->garages,
            pools: $property->pools,
            address: $property->address,
            map: $property->map,
            views: $property->views,
            condition: $property->condition?->name,
            neighborhood: $property->neighborhood?->name,
            propertyType: $property->propertyType?->name,
            status:$property->status?->name,
            broker: $property->broker?->name,
            slug: $property->slug,
            forRent: $property->for_rent,
            businessRule: $property->businessRule?->name,
            propertyPurpose:$property->propertyPurpose?->name,
            intermediationRule: $property->intermediationRule?->name,
            media: Lazy::whenLoaded('media', $property, fn () => ! is_null($property->getFirstMedia('images')) ?
            MediaData::fromModel($property->getFirstMedia('images')) :
            null),
            images: Lazy::whenLoaded('media', $property, fn () => MediaData::collect($property->getMedia('images'))),
            approved: $property->approved,
            approvedAt: $property->approved_at,
            approvedBy: $property->approvedBy?->name,
        );
    }
}
