<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'auth'], function () {

    // login route
    Route::post('/login', 'Auth\ApiController@login');

});

Route::group(['middleware' => 'auth:api'], function() {

    // logout
    Route::get('/logout', 'Auth\ApiController@logout');

    // santri
    Route::group(['middleware' => 'role:9'], function() {

        // wakatime
        Route::get('/wakatime/dashboard', 'Api\WakatimeController@dashboard');
    
    });

});
