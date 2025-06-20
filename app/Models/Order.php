<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    const STATUS_PENDING = 0;
    const STATUS_PROCESSING = 1;
    const STATUS_COMPLETED = 2;
    const STATUS_CANCELLED = 3;

    const PAYMENT_STATUS_PENDING = 0;
    const PAYMENT_STATUS_PAID = 1;
    const PAYMENT_STATUS_FAILED = 2;

    protected $fillable = [
        'user_id',
        'total_amount',
        'status',
        'payment_status',
        'payment_method',
        'shipping_address',
        'shipping_phone',
        'notes',
        'order_details'
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'status' => 'integer',
        'payment_status' => 'integer',
        'order_details' => 'json'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getStatusTextAttribute()
    {
        return match($this->status) {
            self::STATUS_PENDING => 'قيد الانتظار',
            self::STATUS_PROCESSING => 'قيد المعالجة',
            self::STATUS_COMPLETED => 'مكتمل',
            self::STATUS_CANCELLED => 'ملغي',
            default => 'غير معروف'
        };
    }

    public function getPaymentStatusTextAttribute()
    {
        return match($this->payment_status) {
            self::PAYMENT_STATUS_PENDING => 'قيد الانتظار',
            self::PAYMENT_STATUS_PAID => 'مدفوع',
            self::PAYMENT_STATUS_FAILED => 'فشل',
            default => 'غير معروف'
        };
    }

    public function isPending()
    {
        return $this->status === self::STATUS_PENDING;
    }

    public function isProcessing()
    {
        return $this->status === self::STATUS_PROCESSING;
    }

    public function isCompleted()
    {
        return $this->status === self::STATUS_COMPLETED;
    }

    public function isCancelled()
    {
        return $this->status === self::STATUS_CANCELLED;
    }

    public function isPaid()
    {
        return $this->payment_status === self::PAYMENT_STATUS_PAID;
    }
} 