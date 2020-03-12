<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class IzinNotif extends Notification
{
    use Queueable;

    public function via($notifiable)
    {
        return [TelegramChannel::class];
    }

    public function toTelegram($notifiable)
    {
        $urlQodr     = config('app.debug') ? 'https://samarinda.qodr.or.id' : config('app.url');
        $information = $notifiable->info;
        $nameUser    = $notifiable->user;

        $content  = "📝 *IZIN SANTRI QODR SAMARINDA*\n";
        $content .= "=============================\n\n";
        $content .= "👤 *$nameUser*\n\n";
        $content .= $information . "\n\n";
        $content .= "Fii Amanillah. 👍";

        return TelegramMessage::create()
            ->to("$notifiable->token")
            ->content($content)
            ->button('Qodr Apps', $urlQodr);
    }
}
