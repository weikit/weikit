<?php

// Captcha
Route::get('captcha/{config?}', 'CaptchaController@getCaptcha')->middleware(['web', 'guest'])->name('captcha');
Route::prefix('api/v1')->get('captcha/{config?}', 'CaptchaController@getCaptchaApi')->middleware(['api', 'guest'])->name('captcha.api');

Route::group([
    'as' => 'admin.',
    'prefix' => config('weikit.admin.prefix', 'admin')
], function () {

    Route::get('/', 'DashboardController@page')->middleware(['web', 'auth:admin'])->name('dashboard');

    Route::group([
        'namespace' => 'Auth',
        'as' => 'auth.'
    ], function() {

        // Login
        Route::get('login', 'LoginController@page')->middleware(['web', 'guest'])->name('login');
        Route::prefix('api/v1')->post('login', 'LoginController@api')->middleware(['api', 'guest'])->name('login.api');
    });


    Route::group([
        'namespace' => 'Menu',
        'as' => 'menu.'
    ], function() {

        Route::prefix('api/v1')->get('/', 'IndexController@api')->middleware(['api', 'auth:admin'])->name('api');

        // Menu
        Route::get('menu', 'ListController@page')->middleware(['web', 'auth:admin'])->name('list');
        Route::prefix('api/v1')->post('menus', 'ListController@api')->middleware(['web', 'auth:admin'])->name('list.api');
    });

});

