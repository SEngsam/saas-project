<?php

namespace App\Repositories\Eloquent;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationRepository
{
    public function getNotifications($userId, $limit = 10)
    {
        return  Auth::user()->notifications()->orderBy('created_at', 'desc')->limit($limit)->get();
    }

    public function markAsRead($notificationId)
    {
        $notification = Notification::find($notificationId);
        if ($notification) {
            $notification->update(['read_at' => now()]);
            return true;
        }
        return false;
    }

    public function createNotification($userId, $type, array $data)
    {
        return Notification::create([
            'user_id' => $userId,
            'type' => $type,
            'data' => $data,
        ]);
    }
}
