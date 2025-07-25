<?php

namespace Database\Seeders;

use App\Enums\ProviderPermissionEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class ProviderPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = ProviderPermissionEnum::cases();
        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission->value,
                'guard_name' => $permission->role(),
            ]);
        }
    }
}
