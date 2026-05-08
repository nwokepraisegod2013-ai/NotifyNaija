<?php

namespace App\Jobs;

use App\Services\NotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Bus\Dispatchable;
use Throwable;

class SendNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Number of times the job may be attempted.
     */
    public int $tries = 3;

    /**
     * Seconds before job times out.
     */
    public int $timeout = 30;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public array $data
    ) {}

    /**
     * Execute the job.
     */
    public function handle(NotificationService $service): void
    {
        $service->send($this->data);
    }

    /**
     * Handle failed job.
     */
    public function failed(Throwable $exception): void
    {
        logger()->error('Notification Job Failed', [
            'data' => $this->data,
            'error' => $exception->getMessage(),
        ]);
    }
}