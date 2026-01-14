<?php

namespace App\Services\RabbitMQ;

use PhpAmqpLib\Channel\AMQPChannel;
use Illuminate\Support\Facades\Log;
use Exception;

class RabbitMQConsumer
{
    private AMQPChannel $channel;  // RabbitMQ channel
    private string $queue;  // Queue name
    private $callback;  // User-defined callback for processing messages

    public function __construct(string $queue)
    {
        $this->queue = $queue;
        $this->channel = RabbitMQConnection::getChannel($queue);
    }

    /**
     * Set up and consume messages from queue
     */
    public function consume(callable $callback): void
    {
        try {
            $this->callback = $callback;

            // Get worker settings
            $config = config("rabbitmq.workers.{$this->queue}");
            $prefetchCount = $config['prefetch_count'] ?? 10;

            // Set QoS "Do NOT send me more than N unacked messages at a time"
            $this->channel->basic_qos(0, $prefetchCount, false);

            // Declare queue if not exists
            $this->channel->queue_declare(
                $this->queue,
                false,  // passive=false create if not exists
                true,   // durable=true survives broker restart
                false,  // exclusive=false multiple consumers
                false,  // auto_delete = false
                false,  // no_wait = false
                new \PhpAmqpLib\Wire\AMQPTable(
                    config("rabbitmq.queues.{$this->queue}.arguments", [])
                )
            );

            Log::info("Consumer started for queue: {$this->queue}");

            // Register callback
            $this->channel->basic_consume(
                $this->queue,
                '',  // consumer tag
                false, // no_local
                false, // no_ack (auto ack disabled)
                false,  // exclusive
                false,  // no_wait
                [$this, 'processMessage'] // Callback method
            );

            // Keep consuming
            while (true) {
                try {
                    $this->channel->wait(null, false, 30); // 30 second timeout
                } catch (Exception $e) {
                    Log::warning("Consumer wait timeout: {$e->getMessage()}");
                    break;
                }
            }
        } catch (Exception $e) {
            Log::error("Consumer error: {$e->getMessage()}");
            throw $e;
        }
    }

    /**
     * Process individual message (called for each message)
     */
    public function processMessage($message): void
    {
        try {
            $data = json_decode($message->body, true);

            Log::info("Processing message from {$this->queue}", $data);

            // Call the callback function
            $result = call_user_func($this->callback, $data, $message);

            if ($result === true) {
                // Acknowledge message (remove from queue)
                $message->ack();
                Log::info("Message acknowledged");
            } else {
                // Negative acknowledge (requeue or send to DLQ)
                $message->nack(true);
                Log::warning("Message nacked, will be requeued");
            }
        } catch (Exception $e) {
            Log::error("Error processing message: {$e->getMessage()}", [
                'body' => $message->body,
            ]);

            // Nack the message
            $message->nack(true);
        }
    }

    /**
     * Stop consuming
     */
    public function stop(): void
    {
        $this->channel->basic_cancel('');
        $this->channel->close();
    }
}
