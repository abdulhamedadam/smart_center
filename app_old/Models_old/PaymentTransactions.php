<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentTransactions extends Model
{
    protected $guarded = [];
    protected $table ='tbl_course_payment_transactions';

    /**************************************************/
    public function coursePayment()
    {
        return $this->belongsTo(CoursePayments::class,'course_payment_id','id');
    }
    /**************************************************/
    public function course_installment()
    {
        return $this->belongsTo(CourseInstallments::class,'installment_id','id');
    }
}
