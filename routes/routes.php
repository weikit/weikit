<?php

// Captcha
Route::get('captcha/{config?}', 'CaptchaController@getCaptcha')->middleware(['web'])->name('captcha.image');
Route::prefix('api/v1')->get('captcha/{config?}', 'CaptchaController@getCaptchaApi')->middleware(['api'])->name('captcha');

Route::group([
    'as' => 'admin.',
    'prefix' => config('weikit.prefix')
], function () {

    Route::get('/', 'DashboardController@page')->middleware(['web', 'auth.admin'])->name('dashboard');

    Route::group([
        'namespace' => 'Auth',
        'as' => 'auth.',
    ], function() {

        // Login
        Route::get('login', 'LoginController@page')->middleware(['web', 'guest.admin'])->name('login.page');
        Route::prefix('api/v1')->post('login', 'LoginController@api')->middleware(['api', 'guest.admin'])->name('login');
    });

    Route::group([
        'namespace' => 'Auth',
        'as' => 'auth.',
        'prefix' => 'auth'
    ], function() {
        // user info
        Route::prefix('api/v1')->get('user', 'UserController@api')->middleware(['api', 'auth.admin'])->name('user');
    });


    Route::group([
        'namespace' => 'Menu',
        'as' => 'menu.',
        'prefix' => 'menu'
    ], function() {
        // Admin Menu data
        Route::prefix('api/v1')->get('/', 'MenuController@api')->middleware(['api', 'auth.admin'])->name('data');

        // Menu Manage
        Route::get('list', 'ListController@page')->middleware(['web', 'auth:admin'])->name('list.page');
        Route::prefix('api/v1')->post('list', 'ListController@api')->middleware(['api', 'auth.admin'])->name('list');

        // Menu Items Mange
        Route::get('item', 'ItemController@page')->middleware(['web', 'auth.admin'])->name('item.page');
        Route::prefix('api/v1')->post('item', 'ItemController@api')->middleware(['api', 'auth.admin'])->name('item');
    });

    Route::group([
        'namespace' => 'Example',
        'as' => 'example',
        'prefix' => 'example',
    ], function() {
        Route::get('component', 'ComponentController@page')->middleware(['web', 'auth.admin'])->name('component');
    });

});
