<?php

namespace App\Services\Notifications;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;

class RealtimeService
{
    /**
     * Broadcast notification to user
     */
    public function broadcast(array $messageData): bool
    {
        try {
            $userId = $messageData['user_id'];
            $data = $messageData['data'];

            // Broadcast using Laravel's broadcasting
            Broadcast::channel("user.{$userId}", function ($user) use ($userId) {
                return $user->id === $userId;
            });

            // Send the notification
            broadcast(new NotificationBroadcasted(
                $userId,
                $data
            ));

            Log::info("Notification broadcasted to user {$userId}");

            return true;
        } catch (\Exception $e) {
            Log::error("Realtime broadcast failed: {$e->getMessage()}");
            return false;
        }
    }
}
