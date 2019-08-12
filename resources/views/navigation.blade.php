@if(config('nova_permission.show_roles_in_navigation') || config('nova_permission.show_permissions_in_navigation'))
@if (Auth::user()->can('viewAny', app(\Spatie\Permission\PermissionRegistrar::class)->getRoleClass()) ||
Auth::user()->can('viewAny', app(\Spatie\Permission\PermissionRegistrar::class)->getPermissionClass()))
<h3 class="flex items-center font-normal text-white mb-6 text-base no-underline">
    <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
        <path fill="var(--sidebar-icon)"
            d="M7 10V7a5 5 0 1 1 10 0v3h2a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-8c0-1.1.9-2 2-2h2zm2 0h6V7a3 3 0 0 0-6 0v3zm-4 2v8h14v-8H5zm7 2a1 1 0 0 1 1 1v2a1 1 0 0 1-2 0v-2a1 1 0 0 1 1-1z" />
    </svg>
    <span class="sidebar-label">
        @lang('nova-permission-tool::navigation.sidebar-label')
    </span>
</h3>

<ul class="list-reset mb-8">

    @if(config('nova_permission.show_roles_in_navigation'))
    @can('viewAny', app(\Spatie\Permission\PermissionRegistrar::class)->getRoleClass())
    <li class="leading-wide mb-4 text-sm">
        <router-link :to="{
                    name: 'index',
                    params: {
                        resourceName: 'roles'
                    }
                }" class="text-white ml-8 no-underline dim">
            @lang('nova-permission-tool::resources.Roles')
        </router-link>
    </li>
    @endcan
    @endif

    @if(config('nova_permission.show_permissions_in_navigation'))
    @can('viewAny', app(\Spatie\Permission\PermissionRegistrar::class)->getPermissionClass())
    <li class="leading-wide mb-4 text-sm">
        <router-link :to="{
                name: 'index',
                params: {
                    resourceName: 'permissions'
                }
            }" class="text-white ml-8 no-underline dim">
            @lang('nova-permission-tool::resources.Permissions')
        </router-link>
    </li>
    @endcan
    @endif

</ul>
@endif
@endif
