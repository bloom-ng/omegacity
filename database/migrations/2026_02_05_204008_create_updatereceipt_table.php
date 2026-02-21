<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('update_receipts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->cascadeOnDelete();
            $table->date('date');

            $table->json('receipt_items');

            // Tax as percentage
            $table->decimal('tax', 5, 2)->default(0);
            $table->decimal('discount', 10, 2)->default(0);

            $table->enum('payment_type', ['full_payment', 'installment'])
                ->default('full_payment');

            $table->decimal('grand_total', 10, 2)->default(0);

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::dropIfExists('update_receipts');
    }
};
