<?php

namespace Database\Seeders;

use App\Enums\AdminPermissionEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class AdminPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = AdminPermissionEnum::cases();
        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission->value,
                'guard_name' => $permission->role(),
            ]);
        }
    }
}
