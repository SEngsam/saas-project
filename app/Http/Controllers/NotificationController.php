<?php
namespace App\Http\Controllers;

use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    // API to get notifications for logged in user
    public function index()
    {
        $user = Auth::user();
        $notifications = $this->notificationService->getNotificationsForUser($user->id);
        return inertia('Notifications/Index', ['notifications' => $notifications]);
    }

    // Mark a notification as read
    public function markRead($id)
    {
        $this->notificationService->markNotificationRead($id);
        return redirect()->back();
    }
}
