<?php

namespace App\Services\Notifications\Channels;

use Illuminate\Support\Facades\Log;

class EmailChannel implements NotificationChannelInterface
{
    public function send(array $data): void
    {
        Log::info("Email sent", $data);

        // Later:
        // Mail::to(...)->send(...)
    }
}
