<?php

namespace App\Data;

use App\Models\Comment;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;

/** @typescript */
class CommentData extends Data
{
    public function __construct(
        public ?int $id,
        public ?string $comment,
        public ?string $name,
        public ?string $ip,
        public ?int $propertyId,
        public Lazy|null|PropertyData $property
    ) {
    }

    public static function fromModel(Comment $comment)
    {
        return new self(
            id: $comment->id,
            comment: $comment->comment,
            name: $comment->name,
            ip: $comment->ip,
            propertyId: $comment->property_id,
            property: Lazy::whenLoaded('property', $comment, fn () => $comment->property->getData())
        );
    }
}
