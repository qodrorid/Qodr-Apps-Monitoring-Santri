<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

Auth::routes([
    'verify'   => true,
    'reset'    => true,
    'register' => false
]);

Route::middleware(['auth', 'verified'])->group(function() {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    Route::middleware('role:1')->group(function() {
        Route::resource('users', 'UsersController')->except(['create']);
        Route::get('/users/verified/{user}', 'UsersController@verified')->name('users.verified');
        Route::put('/users/reset_password/{user}', 'UsersController@resetPassword')->name('users.reset-password');
    });

});

