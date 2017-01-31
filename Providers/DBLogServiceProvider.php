<?php

namespace App\Components\DBLog\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class DBLogServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();

        $dispatcher = $this->app->make('events');
        $dispatcher->subscribe('App\Components\DBLog\Listeners\DBLogEventListener');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register('Jenssegers\Agent\AgentServiceProvider');

        // Load the Facade aliases
        $loader = AliasLoader::getInstance();
        $loader->alias('Agent', \Jenssegers\Agent\Facades\Agent::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__.'/../Config/config.php' => config_path('dblog.php'),
        ]);
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'dblog'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = base_path('resources/views/components/dblog');

        $sourcePath = __DIR__.'/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ]);

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/components/dblog';
        }, \Config::get('view.paths')), [$sourcePath]), 'dblog');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = base_path('resources/lang/components/dblog');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'dblog');
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'dblog');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
