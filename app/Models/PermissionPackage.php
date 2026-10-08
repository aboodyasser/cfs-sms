<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Permission\Models\Permission;

class PermissionPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    /**
     * العلاقة مع المستخدمين الذين يمتلكون هذه الحزمة.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User, 'permission_package_id');
    }

    /**
     * الصلاحيات التابعة لهذه الحزمة (باستخدام جدول الوسيط المخصص).
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(
            Permission::class,
            'permission_package_has_permissions',
            'permission_package_id',
            'permission_id'
        );
    }

    /**
     * مزامنة الصلاحيات وتحديث صلاحيات المستخدمين المرتبطين تلقائياً.
     */
    public function syncPermissionsWithUsers(array $permissions): void
    {
        $this->permissions()->sync($permissions);

        // تحديث الصلاحيات مباشرة لكل المستخدمين التابعين لهذه الحزمة لضمان التطبيق الفوري
        foreach ($this->users as $user) {
            $user->syncPermissions($this->permissions);
        }
    }
}
