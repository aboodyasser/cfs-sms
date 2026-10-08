<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attachments', function (Blueprint $table) {
            $table->id();
            // علاقة متعددة النماذج (تسمح بربط المرفق بأي جدول مثل Contracts, Payments...)
            $table->morphs('attachable');
            $table->string('title'); // عنوان الملف أو وصفه (مثلاً: صورة شيك الدفعة الأولى)
            $table->string('file_name'); // اسم الملف الأصلي
            $table->string('file_path'); // مسار التخزين في الـ Storage
            $table->string('file_type')->nullable(); // نوع الملف (pdf, image/png, etc.)
            $table->unsignedBigInteger('file_size')->nullable(); // حجم الملف بالبايت
            $table->foreignId('uploaded_by')->constrained('users')->cascadeOnDelete(); // المستخدم الذي قام بالرفع
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attachments');
    }
};
