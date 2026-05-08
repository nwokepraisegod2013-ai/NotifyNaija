<?php

namespace App\Events;

use App\Models\Notification;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotificationViewed implements ShouldBroadcast, ShouldQueue
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public Notification $notification
    ) {}

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('notifications.' . $this->notification->tenant_id),
        ];
    }

    public function broadcastAs(): string
    {
        return 'notification.viewed';
    }

    public function broadcastWith(): array
    {
        return [
            'id' => $this->notification->id,
            'tenant_id' => $this->notification->tenant_id,
            'status' => 'viewed',
            'read_at' => now()->toDateTimeString(),
        ];
    }
}