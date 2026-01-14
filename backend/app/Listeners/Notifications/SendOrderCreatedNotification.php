<?php

namespace App\Listeners\Notifications;

use App\Services\Notifications\NotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendOrderCreatedNotification
{
    /**
     * Create the event listener.
     */
    public function __construct(private NotificationService $notificationService)
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        // Fire and forget - returns immediately
        $this->notificationService->send(
            'order.created',
            $event->order->user_id,
            [
                'order_id' => $event->order->id,
                'user_name' => $event->order->user->name,
                'amount'   => $event->order->total_amount,
            ],
            ['email', 'realtime']
        );
    }
}
