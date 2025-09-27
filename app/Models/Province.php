<?php

namespace App\Models;

use App\Data\ProvinceData;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\LaravelData\WithData;

class Province extends Model
{
    use WithData;

    protected $table = 'provinces';

    protected string $dataClass = ProvinceData::class;

    protected $fillable = [
        'name',
    ];

    public function cities(): Province|HasMany
    {
        return $this->hasMany(City::class);
    }
}
