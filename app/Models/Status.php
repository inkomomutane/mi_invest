<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Data\StatusData;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\LaravelData\WithData;

class Status extends Model
{
    use WithData;

    protected $table = 'statuses';

    protected string $dataClass = StatusData::class;

    protected $fillable = [
        'name',
    ];

    public function properties(): Status|HasMany
    {
        return $this->hasMany(Property::class);
    }
}
