<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;
use Illuminate\Notifications\Notification;
use App\Models\Todo;

class TodoNotif extends Notification
{
    use Queueable;

    private $todo;

    public function __construct($todo) {
        $this->todo = Todo::where('user_id', $todo['user_id'])->where('date', $todo['date'])->first();
    }

    public function via($notifiable)
    {
        return [TelegramChannel::class];
    }

    public function toTelegram($notifiable)
    {
        $urlQodr  = config('app.debug') ? 'https://samarinda.qodr.or.id' : config('app.url');
        $todo     = $this->todo;
        $todoList = json_decode($todo->todo);
        $nameUser = $todo->user->name;

        $content  = "📝 *TODO LIST QODR SAMARINDA*\n";
        $content .= "=============================\n\n";
        $content .= "👤 *$nameUser*\n\n";

        foreach ($todoList as $key => $item) {
            $content .= "=> $item->todo\n";
        }

        $content .= "\nJangan lupa untuk di laksanakan semua yaa\n\n";
        $content .= "Have a nice day. 👍";

        return TelegramMessage::create()
            ->to("$notifiable")
            ->content($content)
            ->button('Qodr Apps', $urlQodr);
    }
    
}
