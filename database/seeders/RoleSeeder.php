<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Enums\StatusEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cases=RoleEnum::cases();
    
        foreach (  $cases as $roleEnum) {
            Role::updateOrCreate(
                ['name' => $roleEnum->value, 'guard_name' => $roleEnum->guard()]
            );
        
    }
}
}
