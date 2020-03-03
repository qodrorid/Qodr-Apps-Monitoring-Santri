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
Route::get('/', function () {
    return redirect('login');
});

// disactive register and active verify
Auth::routes([
    'verify'   => true,
    'reset'    => true,
    'register' => false
]);

// access user auth and verified
Route::middleware(['auth', 'verified'])->group(function() {

    // dashboard
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    // access only for super user
    Route::middleware('role:1')->group(function() {

        // crud users, verified, detail, and reset password
        Route::resource('users', 'UsersController')->except(['create']);
        Route::get('/users/verified/{user}', 'UsersController@verified')->name('users.verified');
        Route::put('/users/reset_password/{user}', 'UsersController@resetPassword')->name('users.reset-password');

        // list and update roles
        Route::resource('roles', 'RolesController')->except(['create', 'show', 'store']);

    });

});

