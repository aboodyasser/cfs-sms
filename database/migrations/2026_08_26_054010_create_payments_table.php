<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->string('payment_number', 50)->unique();

            $table->foreignId('invoice_id')
                ->nullable()
                ->constrained('invoices')
                ->nullOnDelete();

            $table->foreignId('income_id')
                ->nullable()
                ->constrained('incomes')
                ->nullOnDelete();

            $table->foreignId('project_id')
                ->nullable()
                ->constrained('projects')
                ->nullOnDelete();

            $table->foreignId('processed_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->enum('payment_type', [
                'expense',
                'income',
            ]);

            $table->decimal('amount', 15, 2);

            $table->date('payment_date');

            $table->string('payment_method', 50);

            $table->string('reference_number', 100)->nullable();

            $table->text('description')->nullable();

            $table->enum('status', [
                'pending',
                'completed',
                'cancelled',
            ])->default('completed');

            $table->timestamps();
            $table->softDeletes();

            $table->index('invoice_id');
            $table->index('income_id');
            $table->index('project_id');
            $table->index('payment_date');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
