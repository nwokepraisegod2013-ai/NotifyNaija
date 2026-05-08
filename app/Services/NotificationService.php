<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\AuditLog;
use App\Events\NotificationSent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class NotificationService
{
    public function send($user, string $channel, string $title, string $message)
    {
        return DB::transaction(function () use ($user, $channel, $title, $message) {

            /**
             * 1. CREATE NOTIFICATION (CORE SYSTEM)
             */
            $notification = Notification::create([
                'user_id' => $user->id ?? null,
                'channel' => $channel, // ✅ FIXED (was type)
                'title' => $title,
                'message' => $message,
                'status' => 'sent',
                'sent_at' => now(),
            ]);

            /**
             * 2. AUDIT LOG (SAAS TRACEABILITY LAYER)
             */
            AuditLog::create([
                'user_id' => $user->id ?? null,
                'action' => 'SEND_NOTIFICATION',
                'description' => json_encode([
                    'title' => $title,
                    'channel' => $channel,
                    'notification_id' => $notification->id,
                ]),
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);

            /**
             * 3. ⚡ REAL-TIME METRICS (CONSISTENT KEYS)
             */
            Cache::increment('metrics.total_notifications');

            if ($notification->status === 'sent') {
                Cache::increment('metrics.sent');
            }

            if ($notification->status === 'failed') {
                Cache::increment('metrics.failed');
            }

            /**
             * 4. 📡 REAL-TIME BROADCAST (WEBSOCKET LAYER)
             */
            broadcast(new NotificationSent($notification));

            return $notification;
        });
    }
}