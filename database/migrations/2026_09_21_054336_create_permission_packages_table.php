<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('permission_packages', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // مثل: Finance Officer
            $table->string('slug')->unique(); // مثل: finance-officer
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // جدول الربط بين الحزم والصلاحيات (Permissions الخاصة بـ Spatie)
        Schema::create('permission_package_has_permissions', function (Blueprint $table) {
            $table->foreignId('permission_package_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('permission_id');

            // ربط مع جدول permissions الخاص بـ Spatie
            $table->foreign('permission_id')
                ->references('id')
                ->on('permissions')
                ->cascadeOnDelete();

            $table->primary(['permission_package_id', 'permission_id'], 'pkg_perm_primary');
        });

        // إضافة حقل حزمة الصلاحيات لجدول المستخدمين
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('permission_package_id')
                ->nullable()
                ->after('remember_token')
                ->constrained('permission_packages')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['permission_package_id']);
            $table->dropColumn('permission_package_id');
        });

        Schema::dropIfExists('permission_package_has_permissions');
        Schema::dropIfExists('permission_packages');
    }
};
