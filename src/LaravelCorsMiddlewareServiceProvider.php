<?php

namespace AdoraNwodo\LaravelCorsMiddleware;

use Illuminate\Support\ServiceProvider;

class LaravelCorsMiddlewareServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'adoranwodo');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'adoranwodo');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }

        
    }

    protected function configPath()
    {
        return __DIR__ . '/../config/laravelcorsmiddleware.php';
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laravelcorsmiddleware.php', 'laravelcorsmiddleware');

        // Register the service the package provides.
        $this->app->singleton('laravelcorsmiddleware', function ($app) {

            $headers = $app['config']->get('laravelcorsmiddleware');

            return new LaravelCorsMiddleware($headers);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['laravelcorsmiddleware'];
    }
    
    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/laravelcorsmiddleware.php' => config_path('laravelcorsmiddleware.php'),
        ], 'laravelcorsmiddleware.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/adoranwodo'),
        ], 'laravelcorsmiddleware.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/adoranwodo'),
        ], 'laravelcorsmiddleware.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/adoranwodo'),
        ], 'laravelcorsmiddleware.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
