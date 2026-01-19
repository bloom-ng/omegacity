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
        Schema::create('marketers', function (Blueprint $table) {
            $table->id();
            $table->string('passport')->nullable();
            $table->string('full_name');
            $table->string('id_type');
            $table->string('id_file')->nullable();
            $table->string('phone');
            $table->string('email');
            $table->enum('gender', ['Male', 'Female']);
            $table->text('address')->nullable();
            $table->date('dob')->nullable();
            $table->string('occupation')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('account_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('signature')->nullable();
            $table->string('contact_staff')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marketers');
    }
};
