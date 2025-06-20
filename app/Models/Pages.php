<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Pages extends Model implements HasMedia
{
    use HasTranslations;
    use InteractsWithMedia;
    protected $guarded=[];
    protected $translatable = [
        'title',
        'content',
        'meta_title',
        'meta_description'
    ];

    protected $casts = [
        'title' => 'array',
        'content' => 'array',
        'meta_title' => 'array',
        'meta_description' => 'array',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('pages')->singleFile();
        $this->addMediaCollection('page_gallery');
        $this->addMediaConversion('thumb')
            ->width(100)
            ->height(100);
    }
}
