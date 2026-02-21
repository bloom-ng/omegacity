<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('agent_targets', function (Blueprint $table) {
            DB::statement("
            ALTER TABLE agent_targets
            MODIFY target_type ENUM('amount', 'sales', 'leads') NOT NULL
        ");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('agent_targets', function (Blueprint $table) {
             DB::statement("
            ALTER TABLE agent_targets
            MODIFY target_type ENUM('amount', 'sales') NOT NULL
        ");
        });
    }
};
