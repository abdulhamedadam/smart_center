<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CourseStudents extends Model
{
    protected $guarded = [];
    protected $table ='tbl_course_students';
    public static function booted()
    {
        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }

    /********************************************/
    public function student()
    {
      return  $this->belongsTo(Students::class,'student_id','id');
    }
}
