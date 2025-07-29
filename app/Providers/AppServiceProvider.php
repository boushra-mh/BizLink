<?php

namespace App\Providers;
use Spatie\Permission\PermissionRegistrar;
use Spatie\Permission\Models\Role as SpatieRole;
use Spatie\Permission\Models\Permission as SpatiePermission;
use App\Models\Role;
use App\Models\Permission;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
      app(PermissionRegistrar::class)->setRoleClass(Role::class);
    app(PermissionRegistrar::class)->setPermissionClass(Permission::class);
    }
}
