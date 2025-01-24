<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller {
    // Get all notifications for the authenticated user
    public function index(Request $request) {
        // $user          = $request->user();

        // $notifications = $user->notifications;
        $notifications = Notification::get();

        return response()->json(['notifications' =>$notifications],200);

    }

    // Mark a notification as read
    public function markAsRead($id) {
        $notification = Notification::findOrFail($id);
        $notification->update(['is_read' => true]);

        return response()->json(['message' => 'Notification marked as read']);
    }

    // Delete a notification
    public function destroy($id) {
        $notification = Notification::findOrFail($id);
        $notification->delete();

        return response()->json(['message' => 'Notification deleted']);
    }
}
