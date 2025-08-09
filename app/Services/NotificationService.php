<?php
namespace App\Services;

use App\Repositories\Eloquent\NotificationRepository;
class NotificationService
{
    protected $notificationRepo;

    public function __construct(NotificationRepository $notificationRepo)
    {
        $this->notificationRepo = $notificationRepo;
    }

    public function getNotificationsForUser($userId, $limit = 10)
    {
        return $this->notificationRepo->getNotifications($userId, $limit);
    }

    public function markNotificationRead($notificationId)
    {
        return $this->notificationRepo->markAsRead($notificationId);
    }

    public function notifyUser($userId, $type, array $data)
    {
        return $this->notificationRepo->createNotification($userId, $type, $data);
    }
}
