<?php

namespace Weikit\Providers;

use Illuminate\Auth\RequestGuard;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Factory;
use Laravel\Sanctum\Guard;
use Weikit\Captcha\Captcha;
use Weikit\Captcha\Facades\Captcha as CaptchaFacade;

class WeikitServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerConfig();
        $this->registerMigration();
        $this->registerLanguages();
        $this->registerViews();

        $this->registerCaptcha();

        $this->registerGuard();
    }

    /**
     *
     */
    public function registerLanguages()
    {
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'weikit');
    }

    /**
     *
     */
    public function registerConfig()
    {
        $config = [
            'captcha' => [
                __DIR__ . '/../../config/captcha.php' => config_path('captcha.php')
            ],
            'weikit' => [
                __DIR__ . '/../../config/weikit.php' => config_path('weikit.php'),
            ]
        ];

        foreach($config as $key => $data) {
            $this->publishes($data, 'config');
            foreach ($data as $sourceFile => $targetFile) {
                $this->mergeConfigFrom($sourceFile, $key);
            }
        }

        if (!$this->app->configurationIsCached()) {
            config([
                'auth.guards' => array_merge([
                    'admin' => [
                        'driver' => 'admin',
                        'provider' => 'users',
                    ],
                ], config('auth.guards', [])),
            ]);
        }
    }

    public function registerMigration()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'weikit');
    }

    /**
     * Register captcha
     *
     * @return void
     */
    public function registerCaptcha()
    {
        // Bind captcha
        $this->app->bind('captcha', function ($app) {
            return new Captcha(
                $app['Illuminate\Filesystem\Filesystem'],
                $app['Illuminate\Contracts\Config\Repository'],
                $app['Intervention\Image\ImageManager'],
                $app['Illuminate\Session\Store'],
                $app['Illuminate\Hashing\BcryptHasher'],
                $app['Illuminate\Support\Str']
            );
        });

        AliasLoader::getInstance()->alias('Captcha', CaptchaFacade::class);

        /* @var Factory $validator */
        $validator = $this->app['validator'];

        // Validator extensions
        $validator->extend('captcha', function ($attribute, $value, $parameters) {
            return captcha_check($value);
        });

        // Validator extensions
        $validator->extend('captcha_api', function ($attribute, $value, $parameters) {
            return captcha_api_check($value, $parameters[0], $parameters[1] ?? 'default');
        });
    }

    /**
     * Configure the Sanctum authentication guard.
     *
     * @return void
     */
    protected function registerGuard()
    {
        Auth::resolved(function ($auth) {
            $auth->extend('admin', function ($app, $name, array $config) use ($auth) {
                $guard = new RequestGuard(
                    new Guard($auth, config('weikit.admin.auth_expiration'), $config['provider']),
                    $this->app['request'],
                    $auth->createUserProvider($config['provider'] ?? null)
                );

                $app->refresh('request', $guard, 'setRequest');

                return $guard;
            });
        });
    }
}
