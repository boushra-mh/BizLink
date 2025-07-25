<?php

namespace Database\Seeders;

use App\Enums\AdminPermissionEnum;
use App\Enums\CustomerPermissionEnum;
use App\Enums\ProviderPermissionEnum;
use App\Enums\RoleEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // جلب الأدوار
        $roles = RoleEnum::cases();

        foreach ($roles as $roleEnum) {
      
            $role = Role::where('name', $roleEnum->value)
                        ->where('guard_name', $roleEnum->guard())
                        ->first();

            if (!$role) continue;

            
            if ($roleEnum->value === 'admin') {
                $permissions = AdminPermissionEnum::cases();
            } elseif ($roleEnum->value === 'provider') {
                $permissions = ProviderPermissionEnum::cases();
            } elseif ($roleEnum->value === 'customer') {
                $permissions = CustomerPermissionEnum::cases();
            } else {
                $permissions = [];
            }

            
            $permNames = array_map(fn($perm) => $perm->value, $permissions);

          
            $perms = Permission::whereIn('name', $permNames)->get();

           
            $role->syncPermissions($perms);
        }
    }
}
