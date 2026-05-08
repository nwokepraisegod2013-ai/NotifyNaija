<?php

namespace App\Services;

use App\Models\User;
use App\Models\Notification;

class AnalyticsService
{
    /**
     * SaaS Intelligence Overview (Stripe-style metrics layer)
     */
    public function overview(): array
    {
        $total = Notification::count();

        $sent = Notification::where('status', 'sent')->count();
        $failed = Notification::where('status', 'failed')->count();
        $pending = Notification::where('status', 'pending')->count();

        return [
            // Core metrics
            'totalUsers' => User::count(),
            'totalNotifications' => $total,
            'sentNotifications' => $sent,
            'failedNotifications' => $failed,
            'pendingNotifications' => $pending,

            // 🔥 Intelligence metrics
            'deliveryRate' => $total > 0 ? ($sent / $total) * 100 : 0,
            'failureRate' => $total > 0 ? ($failed / $total) * 100 : 0,

            // 🧠 System health score (Stripe-style composite metric)
            'healthScore' => $total > 0
                ? (($sent * 1.0) - ($failed * 1.5)) / $total * 100
                : 100,
        ];
    }
}