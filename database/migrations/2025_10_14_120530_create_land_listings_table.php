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
        Schema::create('land_listings', function (Blueprint $table) {
            $table->id();
            $table->string('property_name');
            $table->string('location');
            $table->decimal('plot_size', 10, 2)->nullable();
            $table->decimal('selling_price', 15, 2)->default(0);
            $table->string('status')->default('available');
            $table->foreignId('sales_agent_id')->nullable()->constrained('users')->nullOnDelete();
            $table->text('description')->nullable();
            $table->json('photos')->nullable();
            $table->text('map_link')->nullable();
            $table->integer('view_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('land_listings');
    }
};
