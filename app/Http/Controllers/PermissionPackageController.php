<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PermissionPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;

class PermissionPackageController extends Controller
{
    /**
     * عرض قائمة حزم الصلاحيات.
     */
    public function index()
    {
        $packages = PermissionPackage::withCount(['users', 'permissions'])
            ->latest()
            ->paginate(10);

        return view('admin.permission-packages.index', compact('packages'));
    }

    /**
     * نموذج إنشاء حزمة صلاحيات جديدة.
     */
    public function create()
    {
        $permissions = Permission::all()->groupBy(function ($permission) {
            // تجميع الصلاحيات حسب البادئة (مثلاً: expenses, projects, users) لتسهيل العرض في الواجهة
            $parts = explode('.', $permission->name);
            return $parts[0] ?? 'general';
        });

        return view('admin.permission-packages.create', compact('permissions'));
    }

    /**
     * حفظ حزمة الصلاحيات الجديدة.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:permission_packages,name'],
            'description' => ['nullable', 'string', 'max:500'],
            'permissions' => ['array'],
            'permissions.*' => ['exists:permissions,id'],
        ]);

        $package = PermissionPackage::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'description' => $validated['description'] ?? null,
        ]);

        if (!empty($validated['permissions'])) {
            $package->permissions()->sync($validated['permissions']);
        }

        return redirect()
            ->route('admin.permission-packages.index')
            ->with('success', 'Permission package created successfully.');
    }

    /**
     * نموذج تعديل حزمة الصلاحيات.
     */
    public function edit(PermissionPackage $permissionPackage)
    {
        $permissionPackage->load('permissions');

        $permissions = Permission::all()->groupBy(function ($permission) {
            $parts = explode('.', $permission->name);
            return $parts[0] ?? 'general';
        });

        $assignedPermissions = $permissionPackage->permissions->pluck('id')->toArray();

        return view('admin.permission-packages.edit', compact('permissionPackage', 'permissions', 'assignedPermissions'));
    }

    /**
     * تحديث حزمة الصلاحيات وتحديث صلاحيات المستخدمين المرتبطين بها فوراً.
     */
    public function update(Request $request, PermissionPackage $permissionPackage)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:permission_packages,name,' . $permissionPackage->id],
            'description' => ['nullable', 'string', 'max:500'],
            'permissions' => ['array'],
            'permissions.*' => ['exists:permissions,id'],
        ]);

        $permissionPackage->update([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'description' => $validated['description'] ?? null,
        ]);

        // مزامنة الصلاحيات وتحديث المستخدمين التابعين تلقائياً باستخدام الدالة التي أنشأناها في الـ Model
        $permissionPackage->syncPermissionsWithUsers($validated['permissions'] ?? []);

        return redirect()
            ->route('admin.permission-packages.index')
            ->with('success', 'Permission package updated successfully.');
    }

    /**
     * حذف حزمة الصلاحيات.
     */
    public function destroy(PermissionPackage $permissionPackage)
    {
        // التحقق مما إذا كانت الحزمة مرتبطة بمستخدمين لكي لا نفقد صلاحياتهم بشكل مفاجئ
        if ($permissionPackage->users()->count() > 0) {
            return back()->with('error', 'Cannot delete package because it is assigned to active users.');
        }

        $permissionPackage->delete();

        return redirect()
            ->route('admin.permission-packages.index')
            ->with('success', 'Permission package deleted successfully.');
    }
}
