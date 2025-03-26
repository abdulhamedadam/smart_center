<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Students extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $table = 'tbl_students';
    protected $guarded = [];
    protected $primaryKey = 'uuid';
    protected $keyType = 'string';
    public $incrementing = false;
    /**********************************************/
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('students')
            ->useDisk('public')
            ->singleFile();
    }
    /**********************************************/
    public static function booted()
    {
        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }
    /**********************************************/
    protected function getImageUrl(?Media $media): ?string
    {
        if (!$media) {
            return null;
        }

        return str_replace('/storage/', '/build/storage/', $media->getUrl());
    }
}
