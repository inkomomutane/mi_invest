<?php

namespace App\Models;

use App\Data\TermData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\WithData;

class Term extends Model
{
    use HasFactory;
    use WithData;

    protected $table = 'terms';

    protected $dataClass = TermData::class;

    protected $appends = ['term'];

    protected $fillable = [
        'terms',
    ];

    public function getTermAttribute()
    {
        return $this->terms;
    }
}
