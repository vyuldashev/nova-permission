<?php

namespace Vyuldashev\NovaPermission;

use Illuminate\Support\Collection;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;
use Spatie\Permission\PermissionRegistrar;
use Spatie\Permission\Traits\HasPermissions;

class RoleSelect extends Select
{
    public function __construct($name, $attribute = null, callable $resolveCallback = null, $labelAttribute = null)
    {
        parent::__construct(
            $name,
            $attribute,
            $resolveCallback ?? static function (Collection $roles) {
                return optional($roles->first())->name;
            }
        );

        $roleClass = app(PermissionRegistrar::class)->getRoleClass();

        $options = $roleClass::get()->pluck($labelAttribute ?? 'name', 'name')->toArray();

        $this->options($options);
    }

    /**
     * @param NovaRequest $request
     * @param string $requestAttribute
     * @param HasPermissions $model
     * @param string $attribute
     */
    protected function fillAttributeFromRequest(NovaRequest $request, $requestAttribute, $model, $attribute)
    {
        if (! $request->exists($requestAttribute)) {
            return;
        }

        $model->roles()->detach();

        if (! is_null($request[$requestAttribute])) {
            $roleClass = app(PermissionRegistrar::class)->getRoleClass();
            $role = $roleClass::where('name', $request[$requestAttribute])->first();
            $model->assignRole($role);
        }
    }

    /**
     * Display values using their corresponding specified labels.
     *
     * @return $this
     */
    public function displayUsingLabels()
    {
        return $this->displayUsing(function ($value) {
            return collect($this->meta['options'])
                ->where('value', optional($value->first())->name)
                ->first()['label'] ?? optional($value->first())->name;
        });
    }
}
