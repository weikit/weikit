<?php

Route::group([
    'as' => 'admin.',
    'prefix' => config('weikit.prefix.admin', 'admin')
], function () {

    Route::get('/', 'DashboardController@layout')->middleware(['auth.admin'])->name('dashboard.layout');
    Route::get('/dashboard', 'DashboardController@index')->middleware(['auth.admin'])->name('dashboard');

    Route::group([
        'namespace' => 'Auth',
        'as' => 'auth.',
    ], function() {
        // Login
        Route::get('login', 'LoginController@page')->middleware(['guest.admin'])->name('login.page');
        Route::post('login', 'LoginController@login')->middleware(['guest.admin'])->name('login');
    });


    Route::group([
        'as' => 'user.',
    ], function() {
        // Login
        Route::get('users', 'UserController@index')->middleware(['auth.admin'])->name('index');
        Route::get('users/search', "UserController@search")->middleware(['auth.admin'])->name('search');
        Route::get('users/create', "UserController@create")->middleware(['auth.admin'])->name('create');
        Route::post('users', "UserController@store")->middleware(['auth.admin'])->name('store');
        Route::get('users/{user}', "UserController@view")->middleware(['auth.admin'])->name('view');
        Route::get('users/{user}/edit', "UserController@edit")->middleware(['auth.admin'])->name('edit');
        Route::put('users/{user}', "UserController@update")->middleware(['auth.admin'])->name('update');
        Route::delete('users/{user}', "UserController@delete")->middleware(['auth.admin'])->name('delete');
    });



//    Route::group([
//        'namespace' => 'Menu',
//        'as' => 'menu.',
//        'prefix' => 'menu'
//    ], function() {
//        // Admin Menu data
//        Route::get('/', 'MenuController@admin')->middleware(['auth.admin'])->name('admin');
//
//        // Menu Manage
//        Route::get('list', 'ListController@page')->middleware(['web', 'auth:admin'])->name('list.page');
//        Route::prefix('api/v1')->post('list', 'ListController@api')->middleware(['api', 'auth.admin'])->name('list');
//
//        // Menu Items Mange
//        Route::get('item', 'ItemController@page')->middleware(['web', 'auth.admin'])->name('item.page');
//        Route::prefix('api/v1')->post('item', 'ItemController@api')->middleware(['api', 'auth.admin'])->name('item');
//    });
//
//    Route::group([
//        'namespace' => 'Example',
//        'as' => 'example.',
//        'prefix' => 'example',
//    ], function() {
//        Route::get('component', 'ComponentController@page')->middleware(['web', 'auth.admin'])->name('component');
//        Route::get('remote', 'ComponentController@remote')->middleware(['web', 'auth.admin'])->name('remote');
//    });

});
