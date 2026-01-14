<?php
namespace App\Console\Commands\Worker;

use App\Services\Notifications\EmailService;
use App\Services\RabbitMQ\RabbitMQConsumer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class EmailWorkerCommand extends Command
{
    protected $signature   = 'worker:email {--timeout=0 : Maximum execution time}';
    protected $description = 'Start email notification worker';

    public function handle(): int
    {
        $this->info('Starting Email Worker...');
        Log::info('Email Worker started.');

        // Initialize EmailService
        $emailService = new EmailService();
         // Initialize RabbitMQ consumer for email notifications
        $consumer = new RabbitMQConsumer('notifications.email.queue');

        try {
            // Consume messages and process email notifications
            $consumer->consume(function ($data) use ($emailService) {
                // Process each message
                return $emailService->sendEmailNotification($data);
            });
        } catch (\Exception $e) {
            $this->error("Email Worker encountered an error: {$e->getMessage()}");
            Log::error("Email Worker error: {$e->getMessage()}");
            return 1;
        }
        return 0;
    }

}
