<?php

namespace App\Services\Notifications\Dispatcher;

use App\Services\Notifications\Channels\EmailChannel;
use App\Services\Notifications\Channels\SmsChannel;
use App\Services\Notifications\Channels\PushChannel;
use App\Services\Notifications\Channels\WebhookChannel;

class NotificationDispatcher
{
    public function send(array $data): void
    {
        foreach ($data['channels'] as $channel) {

            match ($channel) {
                'email'   => (new EmailChannel())->send($data),
                'sms'     => (new SmsChannel())->send($data),
                'push'    => (new PushChannel())->send($data),
                'webhook' => (new WebhookChannel())->send($data),
                default   => null,
            };
        }
    }
}
