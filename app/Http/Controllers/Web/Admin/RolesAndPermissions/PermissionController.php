<?php


namespace App\Http\Controllers\Web\Admin\RolesAndPermissions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\RolesAndPermissions\PermissionRequest;
use App\Models\Permission;
use App\Services\Web\Admin\RolesAndPermissions\PermissionService;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function __construct(private PermissionService $permissionService)
    {}

    public function index(Request $request)
    {
        $permissions = $this->permissionService->getAll($request->all());
        return view('admin.permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('admin.permissions.create');
    }

    public function store(PermissionRequest $request)
    {
        $this->permissionService->create($request->validated());
        return redirect()->route('admin.permissions.index')->with('success', 'Permission created successfully.');
    }

    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit', compact('permission'));
    }

    public function update(PermissionRequest $request, Permission $permission)
    {
        $this->permissionService->update($permission, $request->validated());
        return redirect()->route('admin.permissions.index')->with('success', 'Permission updated successfully.');
    }

    public function destroy(Permission $permission)
    {
        $this->permissionService->delete($permission);
        return redirect()->route('admin.permissions.index')->with('success', 'Permission deleted successfully.');
    }
}

