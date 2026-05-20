<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'user_id',
        'book_id',
        'rating',
        'review'
    ];

    // relasi ke buku
    public function book()
    {
        return $this->belongsTo(\App\Models\Book::class);
    }

    // relasi ke user
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}