<?php


namespace App\Services\Web\Admin\RolesAndPermissions;

use App\Models\Permission;
use Illuminate\Support\Facades\DB;

class PermissionService
{
    public function getAll(array $filters = [])
    {
        $query = Permission::query();

        if (isset($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }

        if (isset($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        return $query->latest()->get();
    }

    public function create(array $data): Permission
    {
        return DB::transaction(function () use ($data) {
            return Permission::create([
                'name' => $data['name'],
                'guard_name' => 'web',
                'status' => $data['status'],
            ]);
        });
    }

    public function update(Permission $permission, array $data): Permission
    {
        return DB::transaction(function () use ($permission, $data) {
            $permission->update([
                'name' => $data['name'],
                'status' => $data['status'],
            ]);

            return $permission;
        });
    }

    public function delete(Permission $permission): void
    {
        $permission->delete();
    }
}
