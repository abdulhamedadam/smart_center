<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Service extends Model implements HasMedia
{
    use HasFactory;
    use HasTranslations;
    use InteractsWithMedia;

    const STATUS_ACTIVE = 1;
    const STATUS_NOT_ACTIVE = 0;

    protected $fillable = [
        'title',
        'description',
        'slug',
        'meta_title',
        'meta_description',
        'status'
    ];

    protected $translatable = [
        'title',
        'description',
        'slug',
        'meta_title',
        'meta_description'
    ];

    protected $casts = [
        'title' => 'array',
        'description' => 'array',
        'slug' => 'array',
        'meta_title' => 'array',
        'meta_description' => 'array',
        'status' => 'boolean'
    ];

    public function toggleStatus()
    {
        $this->status = $this->status === self::STATUS_ACTIVE ? self::STATUS_NOT_ACTIVE : self::STATUS_ACTIVE;
        return $this->save();
    }

    public function isActive()
    {
        return $this->status == self::STATUS_ACTIVE;
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('services')->singleFile();
        $this->addMediaCollection('service_gallery');
        $this->addMediaConversion('thumb')
            ->width(100)
            ->height(100);
    }
} 