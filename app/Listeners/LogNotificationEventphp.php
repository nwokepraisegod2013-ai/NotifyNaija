<?php

namespace App\Listeners;

use App\Events\NotificationSent;
use App\Models\AuditLog;
use App\Models\NotificationEvent;
use Illuminate\Support\Facades\Auth;

class LogNotificationEvent
{
    /**
     * Handle the event.
     */
    public function handle(NotificationSent $event): void
    {
        $notification = $event->notification;

        // Normalize payload (safe structured data)
        $payload = [
            'id' => $notification->id,
            'title' => $notification->title,
            'message' => $notification->message,
            'channel' => $notification->channel,
            'status' => $notification->status,
            'created_at' => optional($notification->created_at)?->toDateTimeString(),
        ];

        /*
        |----------------------------------------------------------------------
        | 1. AUDIT LOG (Security / Enterprise tracking)
        |----------------------------------------------------------------------
        */
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'NOTIFICATION_SENT',
            'description' => json_encode($payload),
            'ip_address' => request()?->ip(),
            'user_agent' => request()?->userAgent(),
        ]);

        /*
        |----------------------------------------------------------------------
        | 2. EVENT STREAM (Real-time feed / SaaS activity log)
        |----------------------------------------------------------------------
        */
        NotificationEvent::create([
            'event_type' => 'notification.sent',
            'payload' => json_encode($payload),
        ]);
    }
}