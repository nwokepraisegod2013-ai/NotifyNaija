<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('notification_metrics', function (Blueprint $table) {
            $table->id();

            // 🧠 MULTI-TENANT ISOLATION (CORE SAAS LAYER)
            $table->foreignId('tenant_id')
                ->nullable()
                ->index();

            // 📊 METRIC IDENTIFIER
            $table->string('metric_key');
            // total_notifications, sent, failed, delivery_rate, etc.

            // 📈 METRIC VALUE
            $table->unsignedBigInteger('value')->default(0);

            // ⏱ TIME-SERIES BUCKET (CRITICAL FOR ANALYTICS)
            $table->timestamp('recorded_at');

            $table->timestamps();

            /*
            |--------------------------------------------------------------------------
            | 🚀 SAAS PERFORMANCE INDEXING STRATEGY
            |--------------------------------------------------------------------------
            | These indexes ensure:
            | - fast dashboard queries per tenant
            | - fast time-series aggregation
            | - scalable analytics filtering
            */

            $table->index(['tenant_id', 'metric_key']);
            $table->index(['tenant_id', 'recorded_at']);
            $table->index(['tenant_id', 'metric_key', 'recorded_at']);

            /*
            |--------------------------------------------------------------------------
            | 🔐 DATA INTEGRITY (NO DUPLICATE SNAPSHOTS PER TENANT PER TIME SLOT)
            |--------------------------------------------------------------------------
            */
            $table->unique(
                ['tenant_id', 'metric_key', 'recorded_at'],
                'tenant_metric_time_unique'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification_metrics');
    }
};