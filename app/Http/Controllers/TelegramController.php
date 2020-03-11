<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Curl;

class TelegramController extends Controller
{
    
    public function index()
    {
        $response = Curl::to('https://api.telegram.org/bot' . config('services.telegram-bot-api.token') . '/getUpdates')->asJson()->get();
        $collect  = collect($response->result);

        $telegram = $collect->filter(function ($value, $key) {
            return !empty($value->message);
        });

        return view('pages.telegram.index', compact('telegram'));
    }

}
