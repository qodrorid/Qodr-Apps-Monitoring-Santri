<?php

/*
|--------------------------------------------------------------------------
| Roles Application
|--------------------------------------------------------------------------
| 1. Super User
| 2. Admin
| 3. Ketua
| 4. Sekretaris
| 5. Bendahara
| 6. Divisi IT
| 7. Divisi Agama
| 8. Mitra
| 9. Santri
|--------------------------------------------------------------------------
*/

// auto redirect to login
Route::get('/', 'IndexController@index');

// disactive register and active verify
Auth::routes([
    'verify'   => true,
    'register' => false
]);

// access user auth and verified
Route::middleware(['auth', 'verified'])->group(function() {

    // dashboard
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    // access only for super user
    Route::middleware('role:1')->group(function() {

        // list and update roles
        Route::resource('roles', 'RolesController')->except(['create', 'show', 'store']);

        // crud settings
        Route::resource('settings', 'SettingController')->except(['create', 'show']);

        // crud settings
        Route::resource('branch', 'BranchController')->except(['create', 'show']);

        // crud users, verified, detail, and reset password
        Route::resource('users', 'UsersController')->except(['create']);
        Route::get('/users/verified/{user}', 'UsersController@verified')->name('users.verified');
        Route::put('/users/reset_password/{user}', 'UsersController@resetPassword')->name('users.reset-password');

        // view logs
        Route::get('/logs', 'LogsController@index')->name('logs.index');
        Route::get('/logs/{filename}', 'LogsController@view')->name('logs.view');

        // trash
        Route::get('/trash', 'TrashController@index')->name('trash.index');
        Route::get('/trash/view', 'TrashController@view')->name('trash.view');
        Route::get('/trash/restore/{id}/{table}', 'TrashController@restore')->name('trash.restore');
        Route::get('/trash/delete/{id}/{table}', 'TrashController@delete')->name('trash.delete');
    
    });

    // access only for admin, ketua and divisi It
    Route::middleware('role:2,3,6')->group(function() {

        // wakatime
        Route::get('/wakatime', 'WakatimeController@index')->name('wakatime.index');
        Route::get('/wakatime/report/{userid}', 'WakatimeController@report')->name('wakatime.view-report');
        Route::get('/wakatime/url/list', 'WakatimeController@indexurl')->name('wakatime.index-url');
        Route::get('/wakatime/url/{wakatime}/status', 'WakatimeController@status')->name('wakatime.status');

    });

    // access only for santri
    Route::middleware('role:9')->group(function() {

        // todo list
        Route::get('/todo', 'TodoController@index')->name('todo.index');
        Route::post('/todo/store', 'TodoController@store')->name('todo.store');
        Route::put('/todo/update/{todo}', 'TodoController@update')->name('todo.update');

        // Wakatime
        Route::get('/wakatime/report', 'WakatimeController@report')->name('wakatime.report');
        Route::get('/wakatime/url', 'WakatimeController@url')->name('wakatime.url');
        Route::put('/wakatime/url/{wakatime}', 'WakatimeController@update')->name('wakatime.update');
    
    });


});

