<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Testimonial extends Model implements HasMedia
{
    use HasFactory;
    use HasTranslations;
    use InteractsWithMedia;

    const STATUS_ACTIVE = 1;
    const STATUS_NOT_ACTIVE = 0;

    protected $fillable = [
        'name',
        'position',
        'content',
        'status'
    ];

    protected $translatable = [
        'name',
        'position',
        'content'
    ];

    protected $casts = [
        'name' => 'array',
        'position' => 'array',
        'content' => 'array',
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
        $this->addMediaCollection('testimonials')->singleFile();
        $this->addMediaConversion('thumb')
            ->width(100)
            ->height(100);
    }
} 