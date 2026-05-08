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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();

            // 🧠 MULTI-TENANT CORE (SaaS ISOLATION LAYER)
            $table->foreignId('tenant_id')
                ->index()
                ->nullable();

            // Recipient
            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            // Core content
            $table->string('title');
            $table->text('message');

            // Delivery system
            $table->string('channel'); 
            // email | sms | in_app | push

            // Status tracking (SaaS-grade lifecycle)
            $table->string('status')->default('pending');
            // pending | processing | sent | failed | delivered | read

            // Delivery metadata
            $table->timestamp('sent_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamp('read_at')->nullable();

            // Retry & failure tracking
            $table->unsignedInteger('attempts')->default(0);
            $table->text('error_message')->nullable();

            // Extensibility layer (Twilio, FCM, SMTP, etc.)
            $table->json('metadata')->nullable();

            $table->timestamps();

            // 🚀 PERFORMANCE INDEXING (IMPORTANT FOR SAAS SCALE)
            $table->index(['tenant_id', 'user_id']);
            $table->index(['tenant_id', 'status']);
            $table->index(['tenant_id', 'channel']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};