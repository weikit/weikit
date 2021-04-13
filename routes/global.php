<?php

// Captcha
Route::get('captcha/{config?}', 'CaptchaController@getCaptcha')->middleware(['web'])->name('captcha.image');
Route::prefix('api/v1')->get('captcha/{config?}', 'CaptchaController@getCaptchaApi')->middleware(['api'])->name('captcha');
Route::any('{view}.vue', 'VueController')->where('view', '.*');
