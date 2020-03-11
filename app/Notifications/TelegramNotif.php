<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;
use Illuminate\Notifications\Notification;

class TelegramNotif extends Notification
{
    use Queueable;

    public function via($notifiable)
    {
        return [TelegramChannel::class];
    }

    public function routeNotificationForTelegram()
    {
        return $this->telegram_user_id;
    }

    public function toTelegram($notifiable)
    {
        return TelegramMessage::create()
            ->to('-1001180523947')
            ->content("Hello qodr samarinda members")
            ->button('View Invoice', env('APP_URL'));
    }
    
}
