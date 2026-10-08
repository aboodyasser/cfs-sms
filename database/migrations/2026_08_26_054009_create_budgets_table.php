<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('budgets', function (Blueprint $table) {
            $table->id();

            $table->foreignId('project_id')
                ->constrained('projects')
                ->cascadeOnDelete();

            $table->string('name');

            $table->string('category', 100);

            $table->decimal('allocated_amount', 15, 2);

            $table->decimal('spent_amount', 15, 2)->default(0);

            $table->decimal('remaining_amount', 15, 2)->default(0);

            $table->decimal('spending_percentage', 8, 2)->default(0);

            $table->text('description')->nullable();

            $table->enum('status', [
                'draft',
                'active',
                'closed',
            ])->default('draft');

            $table->timestamps();
            $table->softDeletes();

            $table->index('project_id');
            $table->index('category');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('budgets');
    }
};
