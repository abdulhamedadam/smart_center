<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Category extends Model implements HasMedia
{
    use InteractsWithMedia;
    protected $table = 'tbl_categories';
    protected $guarded = [];


    public static function booted()
    {
        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }
    /****************************************/
    /**********************************************/
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('category')
            ->useDisk('public')
            ->singleFile();
    }


}
