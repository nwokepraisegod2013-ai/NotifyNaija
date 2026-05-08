<?php

namespace App\Services\Notifications\Channels;

use App\Events\NotificationEvent;

class PushChannel implements NotificationChannelInterface
{
    public function send(array $data): void
    {
        event(new NotificationEvent($data));
    }
}
