<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

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

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
    }

}