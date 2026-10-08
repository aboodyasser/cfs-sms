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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            // Basic Project Information
            $table->string('code', 50)->unique();
            $table->string('name');
            $table->text('description')->nullable();

            // Project Management
            $table->foreignId('manager_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('department_id')
                ->nullable()
                ->constrained('departments')
                ->nullOnDelete();

            // Project Location & Donor
            $table->string('donor')->nullable();
            $table->string('location')->nullable();

            // Project Timeline
            $table->date('start_date');
            $table->date('end_date')->nullable();

            // Project Status
            $table->enum('status', [
                'draft',
                'planned',
                'active',
                'on_hold',
                'completed',
                'cancelled',
            ])->default('draft');

            // Project Progress
            $table->unsignedTinyInteger('completion_percentage')
                ->default(0);

            // Financial Information
            $table->decimal('total_budget', 15, 2)
                ->default(0);

            $table->decimal('spent_amount', 15, 2)
                ->default(0);

            $table->decimal('remaining_budget', 15, 2)
                ->default(0);

            $table->decimal('spending_percentage', 8, 2)
                ->default(0);

            // Burn Rate
            $table->decimal('burn_rate', 15, 2)
                ->default(0);

            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index('status');
            $table->index('start_date');
            $table->index('end_date');
            $table->index('manager_id');
            $table->index('department_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
