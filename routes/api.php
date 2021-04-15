<?php
Route::group([
    'as' => 'admin.',
    'prefix' => 'admin'
], function () {

    Route::group([
        'namespace' => 'Auth',
        'as' => 'auth.',
        'prefix' => 'auth'
    ], function() {
        // user info
        Route::prefix('api/v1')->get('user', 'UserController@info')->middleware(['auth.admin'])->name('user');
    });

    Route::group([
        'namespace' => 'Menu',
        'as' => 'menu.',
        'prefix' => 'menu'
    ], function() {
        // admin menu
        Route::prefix('api/v1')->get('/', 'MenuController@admin')->middleware(['auth.admin'])->name('admin');
    });

});
