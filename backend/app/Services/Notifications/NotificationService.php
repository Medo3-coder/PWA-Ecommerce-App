<?php
namespace App\Services\Notifications;

use App\Models\Notification;
use App\Models\NotificationTemplate;
use App\Models\User;
use App\Services\RabbitMQ\RabbitMQProducer;
use Illuminate\Support\Facades\Log;

// (Orchestrator) Notification Service to send notifications via RabbitMQ
class NotificationService
{

    private RabbitMQProducer $producer;

    public function __construct()
    {
        $this->producer = new RabbitMQProducer();
    }


    /**
     * Send notification to user(s)
     */
    public function send(
        string $type,          // Notification type (order_created, promo, etc.)
        int | array $userIds,  // Single user or many
        array $data = [],      // Dynamic template data
        ?array $channels = null// email, sms, realtime (optional)

    ): bool {
        try {
            $userIds  = is_array($userIds) ? $userIds : [$userIds];
            $channels = $channels ?? config("notifications.types.{$type}.channels", ['email']);

            foreach ($userIds as $userId) {
                // Get template for type
                $template = NotificationTemplate::where('type', $type)->first();

                if (! $template) {
                    Log::warning("Template not found for type: {$type}");
                    continue;
                }

                // Create notification record
                $notification = Notification::create([
                    'user_id' => $userId,
                    'type'    => $type,
                    'title'   => $template->name,
                    'message' => $this->renderTemplate($template->body, $data),
                    'data'    => json_encode($data),
                    'status'  => 'pending',
                ]);

                // Publish to each channel (Fan-out pattern)
                foreach ($channels as $channel) {
                    $this->publishToChannel($notification, $channel, $data);
                }
            }

            return true;
        } catch (\Exception $e) {
            Log::error("Notification send failed: {$e->getMessage()}");
            return false;
        }
    }

    /**
     * Send bulk promotional notifications
     */
    public function sendBulk(
        string $type,
        array $criteria = [],
        array $data = []
    ): int {
        // Get users matching criteria
        $query = User::query();

        if (isset($criteria['country'])) {
            $query->where('country', $criteria['country']);
        }
        if (isset($criteria['spent_min'])) {
            $query->where('total_spent', '>=', $criteria['spent_min']);
        }

        $userIds = $query->pluck('id')->toArray();

        $sent = 0;
        foreach (array_chunk($userIds, 100) as $batch) {
            if ($this->send($type, $batch, $data)) {
                $sent += count($batch);
            }
        }

        return $sent;
    }

    // Publish notification to specific channel
    private function publishToChannel(
        Notification $notification, // Notification record
        string $channel,            // Channel: email, sms, realtime
        array $data                 // Dynamic data
    ): void {
        match ($channel) {
            'email'    => $this->producer->publishEmail([
                'notification_id' => $notification->id,
                'user_id'         => $notification->user_id,
                'type'            => $notification->type,
                'data'            => $data,
            ]),
            'sms'      => $this->producer->publish('notifications.topic', 'notifications.sms.send', [
                'notification_id' => $notification->id,
                'user_id'         => $notification->user_id,
                'data'            => $data,
            ]),
            'realtime' => $this->producer->publish('realtime.fanout', '', [
                'notification_id' => $notification->id,
                'user_id'         => $notification->user_id,
                'data'            => $data,
            ]),
            default    => null,
        };
    }

    //It replaces placeholders inside a text with real values from data array
    private function renderTemplate(string $template, array $data): string
    {
        return preg_replace_callback(
            '/\{(\w+)\}/',
            fn($matches) => $data[$matches[1]] ?? $matches[0],
            $template
        );
    }
}


// NotificationService
//      │
//      ▼
// RabbitMQ Producer → email queue
//      │
//      ▼
// RabbitMQ Consumer (Email Worker)
//      │
//      ▼
// NotificationMail
//      │
//      ▼
// Laravel Mail → SMTP Provider
