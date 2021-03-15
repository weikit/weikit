<?php


return [
    'name' => 'Weikit',

    'prefix' => 'admin',

    'default_auth_guard' => 'sanctum',

    'sanctum' => [
        'auto_stateful_host' => true,
        'auto_stateful_middleware' => true,
    ],

    'middleware' => [
        'auth' => Weikit\Http\Middleware\AuthenticateWithAdmin::class,
        'guest' => Weikit\Http\Middleware\RedirectIfAuthenticated::class,
    ],

    'services' => [
        Weikit\Services\Contracts\MenuService::class => Weikit\Services\MenuService::class,
    ]
];
