<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LogsController extends Controller
{
    
    public function index()
    {
        $logs = Storage::disk('logs')->files();
        $view = Storage::disk('logs')->get(end($logs));

        krsort($logs);
        unset($logs[0]);
        
        return view('pages.logs.index', compact('logs', 'view'));
    }

    public function view(Request $request, string $filename)
    {
        if (!$request->ajax()) abort(404);

        $view = Storage::disk('logs')->get($filename);
        return response($view)->header('Content-Type', 'text/plain');
    }

}
