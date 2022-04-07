<?php

namespace Vyuldashev\NovaPermission;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Permission\PermissionRegistrar;

class ForgetCachedPermissions
{
    /**
     * Handle the incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
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
