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
        'as' => 'auth.'
    ], function() {

        // Login
        Route::get('login', 'LoginController@page')->middleware(['web', 'guest.admin'])->name('login.page');
        Route::prefix('api/v1')->post('login', 'LoginController@api')->middleware(['web', 'api', 'guest.admin'])->name('login');
    });


    Route::group([
        'namespace' => 'Menu',
        'as' => 'menu.',
        'prefix' => 'menu'
    ], function() {
        // Admin Menu
        Route::prefix('api/v1')->get('/', 'MenuController@api')->middleware(['api', 'auth.admin'])->name('data');

        // Menu Manage
        Route::get('list', 'ListController@page')->middleware(['web', 'auth:admin'])->name('list.page');
        Route::prefix('api/v1')->post('list', 'ListController@api')->middleware(['api', 'auth.admin'])->name('list');

        // Menu Items Mange
        Route::get('item', 'ItemController@page')->middleware(['web', 'auth.admin'])->name('item.page');
        Route::prefix('api/v1')->post('item', 'ItemController@api')->middleware(['api', 'auth.admin'])->name('item');
    });

});

