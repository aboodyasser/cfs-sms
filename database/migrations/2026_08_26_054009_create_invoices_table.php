<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();

            $table->string('invoice_number', 50)->unique();

            $table->foreignId('project_id')
                ->nullable()
                ->constrained('projects')
                ->nullOnDelete();

            $table->foreignId('budget_id')
                ->nullable()
                ->constrained('budgets')
                ->nullOnDelete();

            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->string('vendor');

            $table->string('title');

            $table->text('description')->nullable();

            $table->date('invoice_date');

            $table->date('due_date')->nullable();

            $table->decimal('subtotal', 15, 2);

            $table->decimal('tax_amount', 15, 2)->default(0);

            $table->decimal('total_amount', 15, 2);

            $table->decimal('paid_amount', 15, 2)->default(0);

            $table->decimal('balance_amount', 15, 2)->default(0);

            $table->enum('status', [
                'draft',
                'submitted',
                'approved',
                'partially_paid',
                'paid',
                'overdue',
                'cancelled',
            ])->default('draft');

            $table->timestamps();
            $table->softDeletes();

            $table->index('project_id');
            $table->index('budget_id');
            $table->index('invoice_date');
            $table->index('due_date');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
