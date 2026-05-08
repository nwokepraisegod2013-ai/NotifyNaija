<?php

namespace App\Jobs;

use App\Models\NotificationMetric;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ProcessNotificationAnalytics implements ShouldQueue
{
    use Queueable;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        /**
         * ⚡ 1. READ REAL-TIME COUNTERS (Redis / Cache)
         * Must match keys used in NotificationService
         */
        $total  = Cache::get('metrics.total_notifications', 0);
        $sent   = Cache::get('metrics.sent', 0);
        $failed = Cache::get('metrics.failed', 0);

        /**
         * 🕒 2. NORMALIZE TIME (minute bucket)
         * Critical for time-series aggregation
         */
        $now = now()->startOfMinute();

        /**
         * 🧠 3. UPSERT (PREVENT DUPLICATES)
         * Uses unique index: (metric_key, recorded_at, tenant_id)
         */
        DB::table('notification_metrics')->upsert(
            [
                [
                    'metric_key' => 'total',
                    'value' => $total,
                    'recorded_at' => $now,
                    'tenant_id' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'metric_key' => 'sent',
                    'value' => $sent,
                    'recorded_at' => $now,
                    'tenant_id' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'metric_key' => 'failed',
                    'value' => $failed,
                    'recorded_at' => $now,
                    'tenant_id' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ],
            ['metric_key', 'recorded_at', 'tenant_id'], // unique keys
            ['value', 'updated_at'] // fields to update
        );

        /**
         * 📊 4. OPTIONAL: DERIVED METRICS CACHE (fast dashboard reads)
         */
        if ($total > 0) {
            Cache::put('metrics.delivery_rate', ($sent / $total) * 100);
            Cache::put('metrics.failure_rate', ($failed / $total) * 100);
        }
    }
}