<?php

// Captcha
Route::get('captcha/{config?}', 'CaptchaController@getCaptcha')->name('captcha');
Route::prefix('api/v1')->get('captcha/{config?}', 'CaptchaController@getCaptchaApi')->name('captcha.api');

Route::group([
    'as' => 'admin.',
    'prefix' => config('weikit.admin.prefix', 'admin')
], function () {

    Route::group([
        'namespace' => 'Auth',
        'as' => 'auth.'
    ], function() {

        // Login
        Route::get('login', 'LoginController@page')->middleware(['guest'])->name('login');
        Route::prefix('api/v1')->post('login', 'LoginController@api')->middleware(['guest'])->name('login.api');
    });

});

