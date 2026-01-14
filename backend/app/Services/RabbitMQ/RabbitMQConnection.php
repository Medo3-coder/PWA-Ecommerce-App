<?php
namespace App\Services\RabbitMQ;

use PhpAmqpLib\Connection\AMQPStreamConnection;

class RabbitMQConnection
{
    private static ?AMQPStreamConnection $connection = null;
    private static array $channels                   = [];

    /**
     * Get or create RabbitMQ connection (singleton pattern)
     */

    public static function getConnection(): AMQPStreamConnection
    {
        if (self::$connection === null || ! self::$connection->isConnected()) {
            self::$connection = new AMQPStreamConnection(
                config('rabbitmq.host'),
                config('rabbitmq.port'),
                config('rabbitmq.username'),
                config('rabbitmq.password'),
                config('rabbitmq.vhost'),
                false,      // ❌ Always keep false (deprecated)
                'AMQPLAIN', // Authentication method
                null,       // Low-level auth response  ❌ Almost never used
                'en_US',
                config('rabbitmq.connection_timeout'),
                config('rabbitmq.read_write_timeout'),
                null, // Context (SSL options) Certificates Custom socket
                true,
                config('rabbitmq.heartbeat')

            );
        }

        return self::$connection;
    }

    /**
     * Get channel for given queue/exchange
     */

    public static function getChannel(string $name)
    {
        if (! isset(self::$channels[$name]) || self::$channels[$name]->is_open() === false) {
            self::$channels[$name] = self::getConnection()->channel();

        }
        return self::$channels[$name];
    }

   /**
     * Close all connections
     */
    public static function closeConnection(): void
    {
        // Close all channels
        foreach (self::$channels as $channel) {
            if ($channel->is_open()){
                $channel->close();
            }
        }
        // Close main connection
        if (self::$connection && self::$connection->isConnected()) {
            self::$connection->close();
        }

        self::$connection = null;
        self::$channels   = [];
    }


}
