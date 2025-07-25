<?php

namespace Database\Seeders;

use App\Enums\CustomerPermissionEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class CustomerPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = CustomerPermissionEnum::cases();
        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission->value,
                'guard_name' => $permission->role(),
            ]);
        } 
    }
}
