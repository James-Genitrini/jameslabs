<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Image\Enums\Fit;

class Image extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = ['alt_text'];

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('preview')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
    }

    public function getImageUrl(): ?string
    {
        return $this->getFirstMediaUrl('images', 'preview') ?: null;
    }
}

