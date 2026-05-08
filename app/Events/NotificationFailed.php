<?php

namespace App\Events;

use App\Models\Notification;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotificationFailed implements ShouldBroadcast, ShouldQueue
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
        return 'notification.failed';
    }

    public function broadcastWith(): array
    {
        return [
            'id' => $this->notification->id,
            'tenant_id' => $this->notification->tenant_id,
            'title' => $this->notification->title,
            'channel' => $this->notification->channel,
            'error_message' => $this->notification->error_message,
            'status' => $this->notification->status,
            'attempts' => $this->notification->attempts,
            'created_at' => $this->notification->created_at?->toDateTimeString(),
        ];
    }
}