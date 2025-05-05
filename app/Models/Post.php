<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Post extends Model implements HasMedia
{
    use InteractsWithMedia;
    protected $fillable = [
        'title',
        'color',
        'content',
        'slug',
        'user_id',
        'thumbnail',
        'published',
        'tags',
    ];

    protected $casts = [
        'tags' => 'array'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}