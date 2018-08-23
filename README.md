# A Laravel Nova tool for Spatie's laravel-permission library

## Installation

You can install the package in to a Laravel app that uses [Nova](https://nova.laravel.com) via composer:

```bash
composer require vyuldashev/nova-spatie-permission
```

Go through the [Installation](https://github.com/spatie/laravel-permission#installation) section in order to setup [laravel-permission](https://packagist.org/packages/spatie/laravel-permission).

Next up, you must register the tool with Nova. This is typically done in the `tools` method of the `NovaServiceProvider`.

```php
// in app/Providers/NovaServiceProvider.php

// ...

public function tools()
{
    return [
        // ...
        new \Vyuldashev\NovaSpatiePermission\NovaSpatiePermissionTool()
    ];
}
```

Finally, add `MorphToMany` fields to you `app/Nova/User` resource:

```php
public function fields(Request $request)
{
    return [
        // ...
        MorphToMany::make('Roles', 'roles', \Vyuldashev\NovaSpatieLaravelPermissionTool\Role::class),
        MorphToMany::make('Permissions', 'permissions', \Vyuldashev\NovaSpatieLaravelPermissionTool\Permission::class),
    ];
}
```

## Usage

A new menu item called "Permissions & Roles" will appear in your Nova app after installing this package.