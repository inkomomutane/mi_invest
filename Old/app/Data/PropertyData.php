<?php

namespace App\Data;

use App\Models\Property;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;

/** @typescript */
class PropertyData extends Data
{
    public function __construct(
        public Lazy|null|int $id,
        public Lazy|null|string $title,
        public Lazy|null|string $description,
        public Lazy|null|string $details,
        public Lazy|null|int $bathrooms,
        public Lazy|null|string $price,
        public Lazy|null|int $year,
        public Lazy|null|int $floors,
        public Lazy|null|string $area,
        public Lazy|null|int $bedrooms,
        public Lazy|null|int $suites,
        public Lazy|null|int $garages,
        public Lazy|null|int $pools,
        public Lazy|null|string $address,
        public Lazy|null|string $map,
        public Lazy|null|int $views,
        public Lazy|null|ConditionData $condition,
        public Lazy|null|NeighborhoodData $neighborhood,
        public Lazy|null|PropertyTypeData $propertyType,
        public Lazy|null|StatusData $status,
        public Lazy|null|UserData $broker,
        public Lazy|null|string $slug,
        public Lazy|null|bool $forRent,
        public Lazy|null|BusinessRuleData $businessRule,
        public Lazy|null|PropertyPurposeData $propertyPurpose,
        public Lazy|null|IntermediationRuleData $intermediationRule,
        public Lazy|null|MediaData $media,
        public Lazy|null|MediaData $images,
        public Lazy|null|bool $approved,
        public Lazy|null|string $approvedAt,
        public Lazy|null|UserData $approvedBy,
    ) {
    }

    public static function fromModel(Property $property)
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
            condition: Lazy::whenLoaded('condition', $property, fn () => $property->condition->getData()),
            neighborhood: Lazy::whenLoaded('neighborhood', $property, fn () => $property->neighborhood->getData()),
            propertyType: Lazy::whenLoaded('propertyType', $property, fn () => $property->propertyType->getData()),
            status: Lazy::whenLoaded('status', $property, fn () => $property->status->getData()),
            broker: Lazy::whenLoaded('broker', $property, fn () => $property->broker->getData()),
            slug: $property->slug,
            forRent: $property->for_rent,
            businessRule: Lazy::whenLoaded('businessRule', $property, fn () => $property->businessRule->getData()),
            propertyPurpose: Lazy::whenLoaded('propertyPurpose', $property, fn () => $property->propertyPurpose->getData()),
            intermediationRule: Lazy::whenLoaded('intermediationRule', $property, fn () => $property->intermediationRule->getData()),
            media: Lazy::whenLoaded('media', $property, fn () => ! is_null($property->getFirstMedia('images')) ?
            MediaData::fromModel($property->getFirstMedia('images')) :
            null),
            images: Lazy::whenLoaded('media', $property, fn () => MediaData::collect($property->getMedia('images'))),
            approved: $property->approved,
            approvedAt: $property->approved_at?->toDateTimeString(),
            approvedBy: Lazy::whenLoaded('approvedBy', $property, fn () => $property->approvedBy?->getData()),
        );
    }
}
