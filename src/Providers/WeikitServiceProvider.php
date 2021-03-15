<?php

namespace Weikit\Providers;

use Illuminate\Routing\Router;
use Illuminate\Validation\Factory;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Weikit\Captcha\Captcha;
use Weikit\Http\Middleware\AuthenticateWithAdmin;
use Weikit\Http\Middleware\RedirectIfAuthenticated;
use Weikit\Captcha\Facades\Captcha as CaptchaFacade;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

class WeikitServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerConfig();
        $this->registerMigration();
        $this->registerLanguages();
        $this->registerViews();

        $this->registerCaptcha();

        $this->registerServices();

        $this->configureMiddleware();
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

        if (!$this->app->runningInConsole() && config('weikit.sanctum.auto_stateful_host')) {
            config([
                'sanctum.stateful' => array_merge([$_SERVER['HTTP_HOST']], (array) config('sanctum.stateful'))
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

    public function registerServices()
    {
        foreach (config('weikit.services') as $contract => $class) {
            $this->app->singleton($contract, $class);
        }
    }

    /**
     * Configure the Admin middleware and priority.
     *
     * @return void
     */
    protected function configureMiddleware()
    {
        if (!$this->app->runningInConsole()) {
            /** @var Router $router */
            $router = $this->app['router'];
            $router->aliasMiddleware('auth.admin', config('weikit.middleware.auth'));
            $router->aliasMiddleware('guest.admin', config('weikit.middleware.guest'));

            if (config('weikit.sanctum.auto_stateful_middleware')) {
                /** @var \Illuminate\Foundation\Http\Kernel $kernel */
                $kernel = $this->app->make(Kernel::class);
                // auto set sanctum middleware to kernel
                $kernel->prependMiddlewareToGroup('api', EnsureFrontendRequestsAreStateful::class);
            }
        }
    }
}
