<?php

namespace App\Console\Commands\Worker;

use App\Services\RabbitMQ\RabbitMQConsumer;
use App\Services\Notifications\RealtimeService;
use Illuminate\Console\Command;

class RealtimeWorkerCommand extends Command
{
    protected $signature = 'worker:realtime {--timeout=0}';
    protected $description = 'Start realtime notification worker';

    public function handle()
    {
        $this->info('Starting Realtime Worker...');

        $realtimeService = new RealtimeService();
        $consumer = new RabbitMQConsumer('notifications.realtime.queue');

        $consumer->consume(function ($data) use ($realtimeService) {
            return $realtimeService->broadcast($data);
        });

        return 0;
    }
}
