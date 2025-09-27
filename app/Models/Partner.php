<?php

namespace App\Models;

use App\Data\PartnerData;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\WithData;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Partner extends Model implements HasMedia
{
    use WithData;
    use InteractsWithMedia;

    protected $table = 'partners';

    public string $dataClass = PartnerData::class;

    protected $fillable = [
        'name'
    ];

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')->width('200')->nonQueued();
    }
}
