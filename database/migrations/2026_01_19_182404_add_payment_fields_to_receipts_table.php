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
        Schema::table('receipts', function (Blueprint $table) {
            $table->enum('payment_type', ['full_payment', 'installmental'])
                  ->default('full_payment')
                  ->after('discount');

            $table->decimal('amount_paid', 10, 2)
                  ->default(0)
                  ->after('payment_type');

            $table->decimal('balance_left', 10, 2)
                  ->default(0)
                  ->after('amount_paid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('receipts', function (Blueprint $table) {
            $table->dropColumn(['payment_type', 'amount_paid', 'balance_left']);
        });
    }
};
