<?php

namespace Vyuldashev\NovaPermission;

use Gate;
use Laravel\Nova\Nova;
use Laravel\Nova\Tool;

class NovaPermissionTool extends Tool
{
    public $roleResource = Role::class;
    public $permissionResource = Permission::class;

    public $rolePolicy = RolePolicy::class;
    public $permissionPolicy = PermissionPolicy::class;

    /**
     * Perform any tasks that need to happen when the tool is booted.
     *
     * @return void
     */
    public function boot()
    {
        Nova::resources([
            $this->roleResource,
            $this->permissionResource,
        ]);

        Gate::policy(config('permission.models.permission'), $this->permissionPolicy);
        Gate::policy(config('permission.models.role'), $this->rolePolicy);
    }

    public function roleResource(string $roleResource)
    {
        $this->roleResource = $roleResource;

        return $this;
    }

    public function permissionResource(string $permissionResource)
    {
        $this->permissionResource = $permissionResource;

        return $this;
    }

    public function rolePolicy(string $rolePolicy)
    {
        $this->rolePolicy = $rolePolicy;

        return $this;
    }

    public function permissionPolicy(string $permissionPolicy)
    {
        $this->permissionPolicy = $permissionPolicy;

        return $this;
    }
}
