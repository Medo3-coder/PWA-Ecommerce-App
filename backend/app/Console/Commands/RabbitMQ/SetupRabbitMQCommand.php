<?php
namespace App\Console\Commands\RabbitMQ;

use App\Services\RabbitMQ\RabbitMQConnection;
use Illuminate\Console\Command;

class SetupRabbitMQCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:setup-rabbit-m-q-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $connection = new RabbitMQConnection();
        $channel    = $connection->getChannel('default');

        // Declare exchanges, queues, and bindings as needed
        foreach (config('rabbitmq.exchanges') as $name => $config) {
            $channel->exchange_declare($name, $config['type'], false, $config['durable']);
        }

        // Declare queues
        foreach (config('rabbitmq.queues') as $name => $config) {
            $channel->queue_declare($name, false, $config['durable']);
        }
        // Create bindings
        foreach (config('rabbitmq.bindings') as $binding) {
            $channel->queue_bind(
                $binding['queue'],
                $binding['exchange'],
                $binding['routing_key']
            );
        }

    $this->info('RabbitMQ setup completed!');

    }


//    Q: Why do you need a RabbitMQ setup command?

// To define and version-control the messaging topology
// (exchanges, queues, bindings) independently of runtime producers and consumers,
// ensuring predictable and repeatable deployments.
}
