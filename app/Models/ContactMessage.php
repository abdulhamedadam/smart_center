<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    const STATUS_UNREAD = 0;
    const STATUS_READ = 1;
    const STATUS_REPLIED = 2;

    protected $fillable = [
        'name',
        'email',
        'message',
        'status'
    ];

    protected $casts = [
        'status' => 'integer'
    ];

    public function isUnread()
    {
        return $this->status === self::STATUS_UNREAD;
    }

    public function isRead()
    {
        return $this->status === self::STATUS_READ;
    }

    public function isReplied()
    {
        return $this->status === self::STATUS_REPLIED;
    }

    public function markAsRead()
    {
        $this->status = self::STATUS_READ;
        return $this->save();
    }

    public function markAsReplied()
    {
        $this->status = self::STATUS_REPLIED;
        return $this->save();
    }
} 