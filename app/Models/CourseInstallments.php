<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseInstallments extends Model
{
    protected $guarded = [];
    protected $table ='tbl_course_installments';

    public function coursePayment()
    {
        return $this->belongsTo(CoursePayments::class,'course_payment_id','id');
    }

    /*****************************************************/
    public function payment_transaction()
    {
        return $this->hasOne(PaymentTransactions::class,'installment_id','id');
    }
}
