<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function success($message = 'Success!', $data = null)
    {
        return response()->json([
            "status"  => true,
            "message" => $message,
            "data"    => $data
        ]);
    }

    protected function error($code, $message = 'Error!')
    {
        return response()->json([
            "status"  => false,
            "message" => $message,
            "data"    => null
        ], $code);
    }

    protected function responseQueryException($error)
    {
        $errorCode = [
            '1364' => 400,
            '1062' => 409
        ];

        return response()->json([
            "status"  => false,
            "message" => $error->errorInfo[2],
            "data"    => null
        ], $errorCode[$error->errorInfo[1]]);
    }
}
