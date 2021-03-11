<?php
use Weikit\Http\Controllers\CaptchaController;
use Weikit\Http\Controllers\ExampleController;

Route::get('captcha/{config?}', [CaptchaController::class, 'getCaptcha'])->name('captcha');

Route::group([
    'name' => 'example.',
    'prefix' => 'example'
],function () {
    Route::get('/', Livewire\Example\Index::class)->name('index');
    Route::get('form', Livewire\Example\Form::class)->name('form');
});

Route::group([
    'name' => 'admin.',
    'prefix' => 'admin'
],function () {
    Route::group([
        'name' => 'auth.'
    ],function () {
        Route::get('login', Livewire\Auth\Login::class)->name('login');
    });
});



