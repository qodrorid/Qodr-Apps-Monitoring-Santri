<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Curl;

class IndexController extends Controller
{

    public function index()
    {
        return redirect('login');
    }
    
}
