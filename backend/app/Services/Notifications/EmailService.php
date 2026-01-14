<?php

namespace App\Services\Notifications;

use App\Models\Notification;
use App\Models\NotificationLogs;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\NotificationMail;
use Exception;

class EmailService
{
    /**
     * Process and send email notification
    */

    public function sendEmailNotification(array $messageData): bool
    {
        try{
            $notificationId = $messageData['notification_id'];
            $userId = $messageData['user_id'];
            $data = $messageData['data'];

            // Get user and notification
            $user = User::find($userId);
            $notification = Notification::find($notificationId);

            if(!$user || !$notification){
                Log::warning("User or notification not found", ['user_id' => $userId, 'notification_id' => $notificationId]);
                return false;
            }

            // Check user preferences
            $settings = $user->notificationSettings?? null;
            if($settings && !$settings->email_enabled){
                Log::info("Email Disabled For User {$userId}");
                return true; // Mark as processed but not sent
            }

            // Send email using Laravel Mailable
            Mail::to($user->email)->send(new NotificationMail($notification, $data));

            // Log success
            NotificationLogs::create([
                'notification_id' => $notificationId,
                'channel'         => 'email',
                'status'          => 'sent',
                'details'         => 'Email sent successfully.',
            ]);

            // Update notification status
            $notification->update([
                'status' => 'sent',
                'sent_at' => now(),
                'channel' => 'email',
            ]);

            Log::info("Email sent to {$user->email} for notification {$notificationId}");
            return true;
        } catch (Exception $e){
            // Log failure
            Log::error("Failed to send email {'notification_data' => $messageData} for notification {$notificationId} to user {$userId}: " . $e->getMessage());

            NotificationLogs::create([
                'notification_id' => $notificationId,
                'channel'         => 'email',
                'status'          => 'failed',
                'details'         => $e->getMessage(),
            ]);

            return false;
        }
    }
}
