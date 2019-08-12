<?php

namespace Vyuldashev\NovaPermission;

use Gate;
use Laravel\Nova\Nova;
use Laravel\Nova\Events\ServingNova;
use Illuminate\Support\ServiceProvider;

class ToolServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'nova-permission-tool');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'nova-permission-tool');

        $this->publishes([
            __DIR__ . '/../resources/lang' => resource_path('lang/vendor/nova-permission-tool'),
        ], 'nova-permission-tool-lang');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/nova-permission-tool'),
        ], 'nova-permission-tool-views');

        $this->publishes([
            __DIR__ . '/config/nova_permission.php' => config_path('nova_permission.php'),
        ], 'nova-permission');

        $this->app->booted(function () {
            $this->routes();
        });

        Gate::policy(config('permission.models.permission'), PermissionPolicy::class);
        Gate::policy(config('permission.models.role'), RolePolicy::class);

        Nova::serving(function (ServingNova $event) {
            //
        });
    }

    /**
     * Register the tool's routes.
     *
     * @return void
     */
    protected function routes()
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/nova_permission.php',
            'nova_permission'
        );
    }
}
