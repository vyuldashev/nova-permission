<?php

declare(strict_types=1);

namespace Vyuldashev\NovaPermission;

use Laravel\Nova\Nova;
use Spatie\Permission\PermissionRegistrar;

class ForgetCachedPermissions
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request|mixed $request
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
            $permissionKey = Nova::resourceForModel(app(PermissionRegistrar::class)->getPermissionClass())::uriKey();

            if ($request->viaRelationship === $permissionKey) {
                app(PermissionRegistrar::class)->forgetCachedPermissions();
            }
        }

        return $response;
    }
}
