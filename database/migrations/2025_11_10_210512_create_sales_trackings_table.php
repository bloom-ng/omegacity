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
        Schema::create('sales_trackings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('id_type')->nullable();
            $table->string('nok_name')->nullable();
            $table->string('nok_phone')->nullable();
            $table->string('occupation')->nullable();
            $table->date('registration_date')->nullable();
            $table->string('sales_rep')->nullable();

            // Property Details
            $table->string('project_name')->nullable();
            $table->string('property_type')->nullable();
            $table->string('plot_unit_no')->nullable();
            $table->string('location')->nullable();
            $table->string('size')->nullable();
            $table->decimal('total_price', 15, 2)->nullable();
            $table->string('payment_option')->nullable();
            $table->decimal('initial_deposit', 15, 2)->nullable();
            $table->date('initial_date')->nullable();

            // Summary
            $table->decimal('total_paid', 15, 2)->default(0);
            $table->decimal('outstanding_balance', 15, 2)->default(0);
            $table->date('next_due_payment')->nullable();
            $table->string('payment_status')->nullable();
            $table->date('last_payment_date')->nullable();
            $table->string('handled_by')->nullable();

            // Notes
            $table->longText('comments')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_trackings');
    }
};
