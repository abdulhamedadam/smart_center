<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Instructor extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $table = 'tbl_instructors';
    protected $guarded = [];


    /**********************************************/
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('instructor')
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
    public function Country()
    {
        return $this->belongsTo(Country::class,'city_id','id');
    }
    /**********************************************/
    public function City()
    {
        return $this->belongsTo(Country::class,'region_id','id');
    }


}
