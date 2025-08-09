<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class SubscriptionSuccess extends Notification
{
    use Queueable;

    protected $planName;

    public function __construct($planName)
    {
        $this->planName = $planName;
    }

    public function via($notifiable)
    {
        return ['database'];
    }


    public function toDatabase($notifiable)
    {
        return [
            'message' => "Your subscription to the plan '{$this->planName}' has been activated successfully.",
            'plan' => $this->planName,
        ];
    }


}
