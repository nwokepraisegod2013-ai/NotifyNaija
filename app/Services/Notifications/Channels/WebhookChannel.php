<?php

namespace App\Services\Notifications\Channels;

use Illuminate\Support\Facades\Http;

class WebhookChannel implements NotificationChannelInterface
{
    public function send(array $data): void
    {
        if (!isset($data['webhook_url'])) return;

        Http::post($data['webhook_url'], $data);
    }
}
