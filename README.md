# A Laravel Nova tool for Spatie's laravel-permission library

[![Latest Version on Packagist](https://img.shields.io/packagist/v/vyuldashev/nova-spatie-permission.svg?style=flat-square)](https://packagist.org/packages/vyuldashev/nova-spatie-permission)
[![Total Downloads](https://img.shields.io/packagist/dt/vyuldashev/nova-spatie-permission.svg?style=flat-square)](https://packagist.org/packages/vyuldashev/nova-spatie-permission)

![screenshot 1](https://raw.githubusercontent.com/vyuldashev/nova-spatie-permission/master/docs/user-resource.png)
![screenshot 2](https://raw.githubusercontent.com/vyuldashev/nova-spatie-permission/master/docs/roles-resource.png)
![screenshot 3](https://raw.githubusercontent.com/vyuldashev/nova-spatie-permission/master/docs/permissions-resource.png)

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
        new \Vyuldashev\NovaSpatiePermission\NovaSpatiePermissionTool(),
    ];
}
```

Finally, add `MorphToMany` fields to you `app/Nova/User` resource:

```php
public function fields(Request $request)
{
    return [
        // ...
        MorphToMany::make('Roles', 'roles', \Vyuldashev\NovaSpatiePermission\Role::class),
        MorphToMany::make('Permissions', 'permissions', \Vyuldashev\NovaSpatiePermission\Permission::class),
    ];
}
```

## Usage

A new menu item called "Permissions & Roles" will appear in your Nova app after installing this package.
