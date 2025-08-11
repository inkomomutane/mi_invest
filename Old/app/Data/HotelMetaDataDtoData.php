<?php

namespace App\Data;

use App\Models\HotelMetaData;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Lazy;

/** @typescript */
class HotelMetaDataDtoData extends Data
{
    public function __construct(
        public readonly ?int $id,
        public readonly ?string $title,
        public readonly ?string $address,
        public readonly ?string $description,
        public readonly ?string $slug,
        public readonly Lazy|PropertyTypeData $propertyTypeData,
        public readonly Lazy|ConditionData|null $conditionData,
        public readonly Lazy|StatusData|null $statusData,
        public readonly Lazy|NeighborhoodData|null $neighborhoodData,
        /** @var HotelData[] $hotels */
        public readonly Lazy|null|DataCollection $hotels,
        /** @var MediaData[] * */
        public Lazy|null|DataCollection $media,
        /** @var AttributeData[] $attributes */
        public readonly DataCollection|Lazy|null $attributes,

    ) {
    }

    public static function fromModel(HotelMetaData $hotelMetaData): self
    {
        return new self(
            id: $hotelMetaData->id,
            title: $hotelMetaData->title,
            address: $hotelMetaData->address,
            description: $hotelMetaData->description,
            slug: $hotelMetaData->slug,
            propertyTypeData: Lazy::whenLoaded(
                'tipoDeProperty',
                $hotelMetaData,
                static   fn () => $hotelMetaData->tipoDeProperty->getData()
            ),
            conditionData: Lazy::whenLoaded(
                'condition',
                $hotelMetaData,
                static   fn () => $hotelMetaData->condition->getData()
            ),
            statusData: Lazy::whenLoaded(
                'status',
                $hotelMetaData,
                static   fn () => $hotelMetaData->status->getData()
            ),
            neighborhoodData: Lazy::whenLoaded(
                'neighborhood',
                $hotelMetaData,
                static fn () => $hotelMetaData->neighborhood->getData()
            ),
            hotels: Lazy::whenLoaded(
                'hotels',
                $hotelMetaData,
                static fn () => $hotelMetaData->hotels->map(function ($hotel) {
                    $hotel->loadMissing('media');

                    return $hotel->getData();
                })
            ),
            media: Lazy::whenLoaded(
                'media',
                $hotelMetaData,
                static fn () => $hotelMetaData->getMedia('main_hotels')->map(fn ($media) => MediaData::fromModel($media))
            ),
            attributes: Lazy::whenLoaded(
                'attributes',
                $hotelMetaData,
                static fn () => AttributeData::collect($hotelMetaData->attributes)
            ),
        );
    }
}
