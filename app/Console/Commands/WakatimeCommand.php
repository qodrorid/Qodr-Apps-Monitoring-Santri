<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\WakatimeUrl;
use App\Jobs\WakatimeJob;

class WakatimeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wakatime:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get reporting wakatime';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $wakatimeUrl = WakatimeUrl::where('status', true)->get();
        foreach ($wakatimeUrl as $item) {
            WakatimeJob::dispatch($item);
        }
    }
}
