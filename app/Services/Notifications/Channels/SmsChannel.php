<?php

namespace App\Services\Notifications\Channels;

use Illuminate\Support\Facades\Log;

class SmsChannel implements NotificationChannelInterface
{
    public function send(array $data): void
    {
        Log::info("SMS sent", $data);

        // Twilio later
    }
}
