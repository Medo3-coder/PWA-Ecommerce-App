<?php

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

    /**
     * GET /api/notifications - Get user notifications
     */
    public function index(Request $request)
    {
        $notifications = auth()->user()->notifications()
            ->orderByDesc('created_at')
            ->paginate(15);

        return response()->json([
            'status' => 'success',
            'data'   => $notifications,
        ]);
    }

    /**
     * GET /api/notifications/{id} - Get single notification
     */
    public function show($id)
    {
        $notification = auth()->user()->notifications()->find($id);

        if (!$notification) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Notification not found',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data'   => $notification,
        ]);
    }

       /**
     * PUT /api/notifications/{id}/read - Mark as read
     */
    public function markAsRead($id)
    {
        $notification = auth()->user()->notifications()->find($id);

        if (!$notification) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Notification not found',
            ], 404);
        }

        $notification->markAsRead();

        return response()->json([
            'status'  => 'success',
            'message' => 'Notification marked as read',
        ]);
    }

      /**
     * DELETE /api/notifications/{id} - Delete notification
     */
    public function destroy($id)
    {
        $notification = auth()->user()->notifications()->find($id);

        if (!$notification) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Notification not found',
            ], 404);
        }

        $notification->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Notification deleted',
        ]);
    }


      /**
     * GET /api/notifications/unread-count - Count unread
     */
    public function unreadCount()
    {
        $count = auth()->user()->unreadNotifications()->count();

        return response()->json([
            'status' => 'success',
            'data'   => ['unread_count' => $count],
        ]);
    }
}
