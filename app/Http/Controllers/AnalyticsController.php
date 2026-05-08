<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Notification;
use Illuminate\Support\Facades\Cache;

class AnalyticsController extends Controller
{
    /**
     * SaaS Analytics Dashboard (Real-Time + Self-Healing Cache)
     */
    public function index()
    {
        return view('dashboard.analytics', $this->getAnalytics());
    }

    /**
     * Central analytics computation layer
     */
    private function getAnalytics(): array
    {
        /**
         * ⚡ CACHE + AUTO-RECOVERY (KEY PART)
         * If Redis resets, DB repopulates automatically
         */
        $totalNotifications = Cache::remember('metrics.total_notifications', 60, function () {
            return Notification::count();
        });

        $sent = Cache::remember('metrics.sent', 60, function () {
            return Notification::where('status', 'sent')->count();
        });

        $failed = Cache::remember('metrics.failed', 60, function () {
            return Notification::where('status', 'failed')->count();
        });

        /**
         * Pending is not always streamed → safer from DB
         */
        $pending = Cache::remember('metrics.pending', 60, function () {
            return Notification::where('status', 'pending')->count();
        });

        $totalUsers = Cache::remember('metrics.users', 120, function () {
            return User::count();
        });

        /**
         * 📊 DERIVED METRICS
         */
        $deliveryRate = $totalNotifications > 0
            ? round(($sent / $totalNotifications) * 100, 2)
            : 0;

        $failureRate = $totalNotifications > 0
            ? round(($failed / $totalNotifications) * 100, 2)
            : 0;

        /**
         * 🧠 STRIPE-STYLE HEALTH SCORE
         */
        $healthScore = $totalNotifications > 0
            ? round((($sent - ($failed * 1.5)) / $totalNotifications) * 100, 2)
            : 100;

        /**
         * 🧾 FINAL RESPONSE
         */
        return [
            'totalUsers' => $totalUsers,

            'totalNotifications' => $totalNotifications,
            'sentNotifications' => $sent,
            'failedNotifications' => $failed,
            'pendingNotifications' => $pending,

            'deliveryRate' => $deliveryRate,
            'failureRate' => $failureRate,
            'healthScore' => $healthScore,
        ];
    }
}