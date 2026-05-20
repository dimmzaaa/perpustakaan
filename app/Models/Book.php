<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'isbn',
        'synopsis',
        'author',
        'publisher',
        'category',
        'year',
        'image',
        'stock',
        'rating',
        'review'
    ];

public function reviews()
{
    return $this->hasMany(\App\Models\Review::class);
}

}
