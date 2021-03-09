<?php

use Weikit\Http\Controllers\CaptchaController;

Route::get('v1/captcha/{config?}', [CaptchaController::class, 'getCaptchaApi'])->name('captcha.api');
