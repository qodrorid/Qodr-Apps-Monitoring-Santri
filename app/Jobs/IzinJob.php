<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Notifications\IzinNotif;
use App\Models\Izin;

use Notification;

class IzinJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $token;
    private $izin;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $token, Izin $izin)
    {
        $this->token = $token;
        $this->izin  = $izin;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = (object) [
            'token' => $this->token,
            'info'  => $this->izin->information,
            'user'  => $this->izin->name
        ];

        Notification::send($data, new IzinNotif);
    }
}
