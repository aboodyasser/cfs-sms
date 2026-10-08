<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('audit_logs', function (Blueprint $table) {
            if (!Schema::hasColumn('audit_logs', 'user_id')) {
                $table->foreignId('user_id')
                    ->nullable()
                    ->constrained('users')
                    ->nullOnDelete();
            }

            if (!Schema::hasColumn('audit_logs', 'event')) {
                $table->string('event', 50);
            }

            if (!Schema::hasColumn('audit_logs', 'auditable_type')) {
                $table->string('auditable_type');
            }

            if (!Schema::hasColumn('audit_logs', 'auditable_id')) {
                $table->unsignedBigInteger('auditable_id');
            }

            if (!Schema::hasColumn('audit_logs', 'old_values')) {
                $table->json('old_values')->nullable();
            }

            if (!Schema::hasColumn('audit_logs', 'new_values')) {
                $table->json('new_values')->nullable();
            }

            if (!Schema::hasColumn('audit_logs', 'url')) {
                $table->string('url', 2048)->nullable();
            }

            if (!Schema::hasColumn('audit_logs', 'ip_address')) {
                $table->ipAddress('ip_address')->nullable();
            }

            if (!Schema::hasColumn('audit_logs', 'user_agent')) {
                $table->text('user_agent')->nullable();
            }

            // ملاحظة: لكي نتحقق من وجود الـ Indexes بدقة لتجنب تكرارها،
            // يمكننا اضافتها بشرط أو اعتماداً على وجود أعمدتها الأساسية:
            if (Schema::hasColumn('audit_logs', 'auditable_type') && Schema::hasColumn('audit_logs', 'auditable_id')) {
                // يمكنك ترك الفهرس يعمل أو استخدام try/catch للآندكسات إن لزم الأمر،
                // ولكن الفحص الشائع للأعمدة يكفي لمنع خطأ الإضافة.
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('audit_logs', function (Blueprint $table) {
            if (Schema::hasColumn('audit_logs', 'user_id')) {
                $table->dropForeign(['user_id']);
            }

            $table->dropIndex('audit_logs_auditable_index');

            try {
                $table->dropIndex(['event']);
                $table->dropIndex(['created_at']);
            } catch (\Exception $e) {
                // لتجنب توقف الـ rollback لو كان الفهرس غير موجود
            }

            $columnsToDrop = [];
            foreach (
                [
                    'user_id',
                    'event',
                    'auditable_type',
                    'auditable_id',
                    'old_values',
                    'new_values',
                    'url',
                    'ip_address',
                    'user_agent',
                ] as $column
            ) {
                if (Schema::hasColumn('audit_logs', $column)) {
                    $columnsToDrop[] = $column;
                }
            }

            if (!empty($columnsToDrop)) {
                $table->dropColumn($columnsToDrop);
            }
        });
    }
};
