<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // For MySQL/MariaDB
        DB::statement("ALTER TABLE contracts MODIFY party_type VARCHAR(255) NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // It's tricky to revert a string back to an enum if it has custom values.
        // But for safety:
        // DB::statement("ALTER TABLE contracts MODIFY party_type ENUM('vendor', 'donor') NOT NULL");
    }
};
