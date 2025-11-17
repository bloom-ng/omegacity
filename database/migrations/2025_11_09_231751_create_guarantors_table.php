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
        Schema::create('guarantors', function (Blueprint $table) {
            $table->id();
            $table->string('candidate_title');
            $table->string('candidate_name');
            $table->boolean('known_candidate');
            $table->string('relationship');
            $table->string('known_duration');
            $table->string('occupation');
            $table->string('guarantor_title');
            $table->string('guarantor_name');
            $table->text('home_address');
            $table->text('office_address');
            $table->string('candidate_name_confirm');
            $table->string('guarantor_email');
            $table->string('id_type');
            $table->string('document_file')->nullable();
            $table->string('id_file')->nullable();
            $table->string('signature_file')->nullable();
            $table->string('phone');
            $table->date('date_signed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guarantors');
    }
};
