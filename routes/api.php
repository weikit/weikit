<?php

use Weikit\Http\Controllers\CaptchaController;

Route::get('captcha/{config?}', [CaptchaController::class, 'getCaptcha'])->name('captcha');
Route::get('captcha/api/v1/{config?}', [CaptchaController::class, 'getCaptchaApi'])->name('captcha.api');
