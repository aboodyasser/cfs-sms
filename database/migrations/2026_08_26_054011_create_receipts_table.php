<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();

            $table->string('receipt_number', 50)->unique();

            $table->foreignId('payment_id')
                ->unique()
                ->constrained('payments')
                ->cascadeOnDelete();

            $table->foreignId('issued_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->date('receipt_date');

            $table->decimal('amount', 15, 2);

            $table->string('description')->nullable();

            $table->enum('status', [
                'active',
                'cancelled',
            ])->default('active');

            $table->timestamps();
            $table->softDeletes();

            $table->index('receipt_date');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('receipts');
    }
};
