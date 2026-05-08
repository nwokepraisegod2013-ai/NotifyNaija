<?php
namespace App\Services\Notifications\Channels;

interface NotificationChannelInterface
{
    public function send(array $data): void;
}
