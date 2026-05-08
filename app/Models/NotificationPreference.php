<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationPreference extends Model
{
    protected $fillable = [
        'user_id', 'email_enabled', 'sms_enabled', 'push_enabled'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}