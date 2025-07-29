<?php

namespace App\Services\Web\Admin\RolesAndPermissions;

use App\Models\Role;
use Illuminate\Support\Facades\DB;

class RoleService
{
    public function getAll(array $filters = [])
    {
        $query = Role::query();

        if (isset($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }

        if (isset($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        return $query->latest()->get();
    }

    public function create(array $data)
    {
           return DB::transaction(function () use ($data) {
        $role = Role::create([
            'name' => $data['name'],
            'guard_name' => 'web',
            'status' => $data['status'],
        ]);
       if (isset($data['permissions'])) {
            $role->syncPermissions($data['permissions']);
        }
        return $role;
    });
    }

    public function update(Role $role, array $data)
    {
        return DB::transaction(function () use ($role, $data) {
            $role->update([
                'name' => $data['name'],
                'status' => $data['status'],
            ]);

            return $role;
        });
    }

    public function delete(Role $role): void
    {
        $role->delete();
    }
}
