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
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();

            // 🧠 MULTI-TENANT ISOLATION LAYER (CRITICAL FOR SAAS)
            $table->foreignId('tenant_id')
                ->index()
                ->nullable();

            // User responsible for the action
            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            // Core audit info
            $table->string('action');
            // e.g LOGIN, LOGOUT, SEND_NOTIFICATION, CREATE_USER, DELETE_NOTIFICATION

            $table->text('description')->nullable();

            // 🔐 SECURITY CONTEXT (VERY IMPORTANT FOR SAAS)
            $table->ipAddress('ip_address')->nullable();
            $table->string('user_agent')->nullable();

            // 🧠 EXTENSIBLE EVENT DATA (for debugging, tracing, analytics)
            $table->json('meta')->nullable();

            $table->timestamps();

            // 🚀 PERFORMANCE INDEXING (SAAS SCALE OPTIMIZED)
            $table->index(['tenant_id', 'user_id']);
            $table->index(['tenant_id', 'action']);
            $table->index(['tenant_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};