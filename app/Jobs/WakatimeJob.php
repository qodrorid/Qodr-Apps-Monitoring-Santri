<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\WakatimeUrl;
use App\Models\WakatimeTracking;

use Curl;

class WakatimeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $wakatime;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(WakatimeUrl $wakatime)
    {
        $this->wakatime = $wakatime;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $wakatime = $this->wakatime;
        $dateNow  = date('Y-m-d');

        $requestEditors        = Curl::to($wakatime->editors)->asJson()->get();
        $requestLanguages      = Curl::to($wakatime->languages)->asJson()->get();
        $requestCodingActivity = Curl::to($wakatime->coding_activity)->asJson()->get();

        $editors        = json_encode($requestEditors->data);
        $languages      = json_encode($requestLanguages->data);
        $codingActivity = collect($requestCodingActivity->data)->filter(function($item) {
            return $item->range->date == date('Y-m-d');
        })->first();

        $total = $codingActivity->grand_total;
        $range = $codingActivity->range;

        WakatimeTracking::updateOrInsert(
            [
                'user_id' => $wakatime->user_id,
                'date'    => $dateNow
            ],
            [
                'user_id'       => $wakatime->user_id,
                'digital'       => $total->digital,
                'hours'         => $total->hours,
                'minutes'       => $total->minutes,
                'text_duration' => $total->text,
                'date'          => $range->date,
                'languages'     => $languages,
                'editors'       => $editors,
                'created_at'    => date('Y-m-d H:s:i'),
                'updated_at'    => date('Y-m-d H:s:i')
            ]
        );
    }
}
