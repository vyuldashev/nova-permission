<?php

namespace Vyuldashev\NovaSpatiePermission;

use Laravel\Nova\Nova;
use Laravel\Nova\Tool;

class NovaSpatiePermissionTool extends Tool
{
    /**
     * Perform any tasks that need to happen when the tool is booted.
     *
     * @return void
     */
    public function boot()
    {
        Nova::script('nova-spatie-laravel-permission-tool', __DIR__.'/../dist/js/tool.js');
        Nova::style('nova-spatie-laravel-permission-tool', __DIR__.'/../dist/css/tool.css');

        Nova::resources([
            Role::class,
            Permission::class,
        ]);
    }

    /**
     * Build the view that renders the navigation links for the tool.
     *
     * @return \Illuminate\View\View
     */
    public function renderNavigation()
    {
        return view('nova-spatie-laravel-permission-tool::navigation');
    }
}
