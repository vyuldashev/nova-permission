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
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'nova-permission-tool');

        $this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/nova-permission-tool'),
        ], 'nova-permission-tool-lang');

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
        //
    }
}
