<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class ApiController extends Controller
{
    
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        $credentials = request(['username', 'password']);
        
        if(!Auth::attempt($credentials)) return $this->error(401, 'Unauthorized');
        
        $user = Auth::user();
        
        $tokenResult = $user->createToken(env('API_KEY'));
        $accessToken = $tokenResult->accessToken;
        
        $tokenResult->token->save();

        $data = $user->toArray();
        $data['accessToken'] = $accessToken;

        return $this->success('Success!', $data);
    }

}
