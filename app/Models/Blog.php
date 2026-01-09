<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'thumbnail',
        'body',
        'author',
        'published_at',
    ];



    protected $casts = [
        'published_at' => 'datetime',
    ];
    protected static function booted()
    {
        static::creating(function ($blog) {
            $blog->slug = Str::slug($blog->title);
        });
    }
}
