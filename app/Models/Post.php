<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Allow mass assignment for all the fields
    protected $fillable = [
        'title',
        'content',
        'category',
        'status',
        'featured_image',
        'published_at'
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];
}
