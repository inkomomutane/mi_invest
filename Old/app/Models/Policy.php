<?php

namespace App\Models;

use App\Data\PolicyData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\WithData;

class Policy extends Model
{
    use HasFactory;
    use WithData;

    protected $table = 'policies';

    protected $dataClass = PolicyData::class;

    protected $fillable = [
        'policies',
    ];
}
