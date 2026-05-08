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
        Schema::create('notification_events', function (Blueprint $table) {
            $table->id();

            // Link to the notification (core relationship)
            $table->foreignId('notification_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            // Event lifecycle stage
            $table->string('event_type');
            // sent, failed, delivered, viewed, clicked, opened

            // Flexible metadata for debugging + analytics
            $table->json('payload')->nullable();

            // Security + tracking context
            $table->ipAddress('ip_address')->nullable();
            $table->string('user_agent')->nullable();

            // Optional delivery channel context
            $table->string('channel')->nullable();
            // email, sms, in_app, push

            $table->timestamps();

            // Indexes for fast dashboard + analytics queries
            $table->index(['notification_id', 'event_type']);
            $table->index(['created_at']);
            $table->index(['channel']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification_events');
    }
};