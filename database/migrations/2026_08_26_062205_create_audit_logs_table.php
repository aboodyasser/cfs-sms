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
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();

            // User who performed the action
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Action information
            $table->string('action', 50);
            $table->string('description');

            // Audited entity
            $table->nullableMorphs('auditable');

            // Request / context information
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();

            // Before / after values
            $table->json('old_values')->nullable();
            $table->json('new_values')->nullable();

            $table->timestamps();

            // Useful indexes
            $table->index('action');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};
