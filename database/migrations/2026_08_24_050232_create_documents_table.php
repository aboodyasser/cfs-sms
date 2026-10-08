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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();

            $table->string('document_number', 50)->unique();

            $table->string('title');

            $table->string('category', 100);

            $table->text('description')->nullable();

            $table->foreignId('project_id')
                ->nullable()
                ->constrained('projects')
                ->nullOnDelete();

            $table->foreignId('expense_id')
                ->nullable()
                ->constrained('expenses')
                ->nullOnDelete();

            $table->foreignId('department_id')
                ->nullable()
                ->constrained('departments')
                ->nullOnDelete();

            $table->foreignId('uploaded_by')
                ->constrained('users')
                ->restrictOnDelete();

            $table->date('document_date')->nullable();

            $table->string('original_name');

            $table->string('stored_name');

            $table->string('disk')->default('local');

            $table->string('path');

            $table->string('mime_type', 150)->nullable();

            $table->unsignedBigInteger('file_size')->default(0);

            $table->string('status', 30)->default('active');

            $table->timestamps();

            $table->softDeletes();

            $table->index('category');
            $table->index('document_date');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
