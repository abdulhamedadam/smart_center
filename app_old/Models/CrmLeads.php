<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CrmLeads extends Model
{
    protected $table='tbl_crm_leads';
    protected $guarded=[];
    const NEW = 1;
    const CONTACTED= 2;
    const CONVERTED = 3;
    const NOTINTERSTED= 4;
    const LOST= 4;


    /*************************************************/
    public function course()
    {
        return $this->belongsTo(Courses::class,'course_id','id');
    }
    /*************************************************/
    public function assignee()
    {
        return $this->belongsTo(User::class,'assigned_to','id');
    }

}
