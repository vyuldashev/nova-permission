<?php

namespace Vyuldashev\NovaPermission;

use Auth;
use Laravel\Nova\Nova;
use Laravel\Nova\Tool;

class NovaPermissionTool extends Tool
{
    /**
     * Perform any tasks that need to happen when the tool is booted.
     *
     * @return void
     */
    public function boot()
    {
        Nova::resources([
            Role::class,
            Permission::class,
        ]);
    }

    /**
     * Build the view that renders the navigation links for the tool.
     *
     * @return \Illuminate\View\View|string
     */
    public function renderNavigation()
    {
        if ($tool = config('permission.nova.tool_role')) {
            return Auth::user()->hasRole($tool)
                ? view('nova-permission-tool::navigation')
                : '';
        }

        return view('nova-permission-tool::navigation');
    }
}
