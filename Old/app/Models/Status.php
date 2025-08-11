<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Data\StatusData;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\WithData;

class Status extends Model
{
    use HasFactory;
    use WithData;

    protected $table = 'statuses';

    protected $dataClass = StatusData::class;

    protected $fillable = [
        'name',
    ];

    public function properties()
    {
        return $this->hasMany(Property::class);
    }
}
