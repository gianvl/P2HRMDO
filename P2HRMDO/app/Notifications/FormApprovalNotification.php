<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FormApprovalNotification extends Notification
{
    use Queueable;

    private $mrNum;

    public function __construct($mrNum)
    {
        $this->mrNum = $mrNum;
    }

    public function via($notifiable)
    {
        return ['database']; // Use the database channel for notifications
    }

    public function toArray($notifiable)
    {
        return [
            'mrNum' => $this->mrNum,
            // Add any additional data you want to store in the notification record
        ];
    }
}
