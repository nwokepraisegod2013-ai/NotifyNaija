<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'user_id', 'title', 'message', 'channel', 'status'
    ];

    public function logs()
    {
        return $this->hasMany(NotificationLog::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
