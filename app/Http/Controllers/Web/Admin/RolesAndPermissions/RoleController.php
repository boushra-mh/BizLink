<?php

namespace App\Http\Controllers\Web\Admin\RolesAndPermissions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\RolesAndPermissions\RoleRequest;
use App\Models\Role;
use App\Services\Web\Admin\RolesAndPermissions\RoleService;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct(private RoleService $roleService)
    {}

    public function index(Request $request)
    {
        $roles = $this->roleService->getAll($request->all());
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function store(RoleRequest $request)
    {
        $this->roleService->create($request->validated());
        return redirect()->route('admin.roles.index')->with('success', 'Role created successfully.');
    }

    public function edit(Role $role)
    {
        return view('admin.roles.edit', compact('role'));
    }

    public function update(RoleRequest $request, Role $role)
    {
        $this->roleService->update($role, $request->validated());
        return redirect()->route('admin.roles.index')->with('success', 'Role updated successfully.');
    }

    public function destroy(Role $role)
    {
        $this->roleService->delete($role);
        return redirect()->route('admin.roles.index')->with('success', 'Role deleted successfully.');
    }
}
