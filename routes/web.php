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

use App\Job\IzinJob;
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

    // access only for super user and admin
    Route::middleware('role:1,2')->group(function() {

        // Telegram Chat Id
        Route::get('/telegram', 'TelegramController@index')->name('telegram.index');

        //Question
        Route::resource('/soal', 'QuestionController');
        Route::resource('/kategori-soal', 'QuestionCategoryController');

        //Survey
        Route::resource('/survey', 'SurveyController');


    });

    // access only for ketua and sekretaris
    Route::middleware('role:3,4')->group(function() {

        // Izin Student
        Route::get('/izin/student', 'IzinController@student')->name('izin.student');
        Route::get('/izin/list/{user}', 'IzinController@list')->name('izin.list');
        Route::put('/izin/approved/{izin}', 'IzinController@approved')->name('izin.approved');

    });

    // access only for ketua and bendahara
    Route::middleware('role:3,5')->group(function() {

        // rab
        Route::resource('rab', 'RabController')->except(['create', 'show', 'edit']);
        Route::post('/rab/create', 'RabController@create')->name('rab.create');

        // cashflow
        Route::resource('cashflow', 'CashFlowController')->except(['create', 'show', 'edit']);

        // credit
        Route::resource('credit', 'CreditController')->except(['create', 'show']);
        Route::get('/credit/refund/{credit}', 'CreditController@refund')->name('credit.refund');

        // income
        Route::resource('income', 'IncomeController')->except(['create', 'show']);

    });

    // access only for ketua and divisiit
    Route::middleware('role:3,6')->group(function() {

        // class it
        Route::resource('classit', 'ClassItController')->except(['create', 'show']);

        // event it
        Route::resource('eventit', 'EventItController')->except(['create', 'show']);

        // cekcok
        Route::resource('cekcok', 'CekcokController')->except(['create', 'show']);

    });

    // access only for admin, ketua and divisi It
    Route::middleware('role:2,3,6')->group(function() {

        // wakatime
        Route::get('/wakatime', 'WakatimeController@index')->name('wakatime.index');
        Route::get('/wakatime/report/{userid}', 'WakatimeController@report')->name('wakatime.view-report');
        Route::get('/wakatime/url/list', 'WakatimeController@indexurl')->name('wakatime.index-url');
        Route::get('/wakatime/url/{wakatime}/status', 'WakatimeController@status')->name('wakatime.status');

        // todo list
        Route::get('/todo/student', 'TodoController@student')->name('todo.student');
        Route::get('/todo/view/{user}', 'TodoController@view')->name('todo.view');

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

        // izin
        Route::resource('izin', 'IzinController')->except(['create', 'show']);

        //survey
        Route::get('/santri/survey', 'SurveyController@santri')->name('survey.santri');
        Route::get('/santri/survey/{id}', 'SurveyController@santriMulai')->name('survey.santri_mulai');
        Route::post('/santri/survey/{id}', 'SurveyController@santriSimpan')->name('survey.santri_simpan');


    });


});

