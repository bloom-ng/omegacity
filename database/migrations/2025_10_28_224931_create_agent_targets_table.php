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
        Schema::create('agent_targets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // the agent
            $table->enum('period_type', ['monthly', 'yearly']); // time dimension
            $table->enum('target_type', ['amount', 'sales']); // what we're measuring (money or count)
            $table->decimal('target_value', 15, 2); // the goal (money or count)
            $table->decimal('achieved_value', 15, 2)->default(0); // current progress
            $table->integer('year'); // e.g., 2025
            $table->integer('month')->nullable(); // 1-12 for monthly, null for yearly
            $table->text('notes')->nullable();
            $table->enum('status', ['active', 'achieved', 'missed', 'cancelled'])->default('active');
            $table->timestamps();
            
            // Ensure one target per agent per period+type combination
            $table->unique(['user_id', 'period_type', 'target_type', 'year', 'month'], 'agent_target_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agent_targets');
    }
};
