<?php

namespace App\Events;

use App\Models\Notification;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotificationSent implements ShouldBroadcast, ShouldQueue
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public Notification $notification
    ) {}

    /**
     * Channel definition (secure real-time stream)
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('notifications'),
        ];
    }

    /**
     * Frontend event name (clean API contract)
     */
    public function broadcastAs(): string
    {
        return 'notification.sent';
    }

    /**
     * Safe, normalized payload for frontend + analytics
     */
    public function broadcastWith(): array
    {
        return [
            'id' => (int) $this->notification->id,
            'title' => (string) $this->notification->title,
            'message' => (string) $this->notification->message,
            'channel' => (string) $this->notification->channel,
            'status' => (string) $this->notification->status,

            // ISO standard timestamp (better for analytics systems)
            'created_at' => optional($this->notification->created_at)
                ? $this->notification->created_at->toISOString()
                : null,
        ];
    }
}