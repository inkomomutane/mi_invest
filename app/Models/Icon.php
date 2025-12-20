<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Icon extends Model
{
    protected $fillable =
        [
            'title',
            'tags',
            'categories',
            'lab',
        ];

    protected function casts(): array
    {
        return [
            'tags' => 'array',
            'categories' => 'array',
        ];
    }
}
