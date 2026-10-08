<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserStoreRequest;
use App\Http\Requests\Admin\UserUpdateRequest;
use App\Models\Department;
use App\Models\PermissionPackage;
use App\Models\Position;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of users.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', User::class);

        $users = User::with([
            'department',
            'position',
            'roles',
            'permissionPackage', // إضافة العلاقة الجديدة لعرض حزمة الصلاحيات
        ])
            ->when($request->filled('q'), function ($query) use ($request) {
                $search = $request->string('q')->toString();

                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where(
                    'status',
                    $request->string('status')->toString()
                );
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $departments = Department::query()
            ->where('status', 'active')
            ->orderBy('name')
            ->get();

        $positions = Position::query()
            ->where('status', 'active')
            ->orderBy('name')
            ->get();

        $roles = Role::query()
            ->orderBy('name')
            ->get();

        $permissionPackages = PermissionPackage::query()
            ->orderBy('name')
            ->get();

        return view('admin.users.index', compact(
            'users',
            'departments',
            'positions',
            'roles',
            'permissionPackages'
        ));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        $this->authorize('create', User::class);

        $departments = Department::query()
            ->where('status', 'active')
            ->orderBy('name')
            ->get();

        $positions = Position::query()
            ->where('status', 'active')
            ->orderBy('name')
            ->get();

        $roles = Role::query()
            ->orderBy('name')
            ->get();

        $permissionPackages = PermissionPackage::query()
            ->orderBy('name')
            ->get();

        return view('admin.users.create', compact(
            'departments',
            'positions',
            'roles',
            'permissionPackages'
        ));
    }

    /**
     * Store a newly created user.
     */
    public function store(UserStoreRequest $request)
    {
        $this->authorize('create', User::class);

        DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'status' => $request->status,
                'department_id' => $request->department_id,
                'position_id' => $request->position_id,
                'permission_package_id' => $request->permission_package_id, // حفظ حزمة الصلاحيات
            ]);

            if ($request->filled('role')) {
                $user->assignRole($request->role);
            }

            // تطبيق الصلاحيات التابعة للحزمة المختارة تلقائياً للمستخدم
            if ($request->filled('permission_package_id')) {
                $package = PermissionPackage::with('permissions')->find($request->permission_package_id);
                if ($package) {
                    $user->syncPermissions($package->permissions);
                }
            }
        });

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Display the specified user.
     */
    public function show(User $user)
    {
        $this->authorize('view', $user);

        $user->load([
            'department',
            'position',
            'roles',
            'permissions',
            'permissionPackage',
        ]);

        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);

        $roles = Role::query()
            ->orderBy('name')
            ->get();

        $departments = Department::query()
            ->where('status', 'active')
            ->orderBy('name')
            ->get();

        $positions = Position::query()
            ->where('status', 'active')
            ->orderBy('name')
            ->get();

        $permissionPackages = PermissionPackage::query()
            ->orderBy('name')
            ->get();

        $user->load([
            'roles',
            'department',
            'position',
            'permissionPackage',
        ]);

        return view('admin.users.edit', compact(
            'user',
            'roles',
            'departments',
            'positions',
            'permissionPackages'
        ));
    }

    /**
     * Update the specified user.
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $this->authorize('update', $user);

        DB::transaction(function () use ($request, $user) {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'status' => $request->status,
                'department_id' => $request->department_id,
                'position_id' => $request->position_id,
                'permission_package_id' => $request->permission_package_id, // تحديث حزمة الصلاحيات
                'password' => $request->filled('password')
                    ? Hash::make($request->password)
                    : $user->password,
            ]);

            if ($request->filled('role')) {
                $user->syncRoles([$request->role]);
            }

            // تحديث الصلاحيات فوراً بما يتوافق مع الحزمة الجديدة
            if ($request->filled('permission_package_id')) {
                $package = PermissionPackage::with('permissions')->find($request->permission_package_id);
                if ($package) {
                    $user->syncPermissions($package->permissions);
                }
            }
        });

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified user.
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        if (\Illuminate\Support\Facades\Auth::id() === $user->id) {
            return back()->withErrors([
                'user' => 'You cannot delete your own account.',
            ]);
        }

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User deleted successfully.');
    }

    /**
     * Activate the specified user.
     */
    public function activate(User $user)
    {
        $this->authorize('update', $user);

        $user->update([
            'status' => 'active',
        ]);

        return back()->with(
            'success',
            'User activated successfully.'
        );
    }

    /**
     * Deactivate the specified user.
     */
    public function deactivate(User $user)
    {
        $this->authorize('update', $user);

        if (\Illuminate\Support\Facades\Auth::id() === $user->id) {
            return back()->withErrors([
                'user' => 'You cannot deactivate your own account.',
            ]);
        }

        $user->update([
            'status' => 'inactive',
        ]);

        return back()->with(
            'success',
            'User deactivated successfully.'
        );
    }
}
