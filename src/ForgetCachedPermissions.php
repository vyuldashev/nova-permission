<?php

declare(strict_types=1);

namespace Vyuldashev\NovaPermission;

use Laravel\Nova\Nova;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ForgetCachedPermissions
{
    /**
     * Handle the incoming request.
     *
     * @param Request|mixed $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle($request, $next)
    {
        $response = $next($request);

        if (
            $request->is('nova-api/*/detach') ||
            $request->is('nova-api/*/*/attach*/*')
        ) {
            $permissionKey = Str::plural(Str::kebab(class_basename(app(PermissionRegistrar::class)->getPermissionClass())));

            if ($request->viaRelationship === $permissionKey) {
                app(PermissionRegistrar::class)->forgetCachedPermissions();
            }
        }

        return $response;
    }
}
