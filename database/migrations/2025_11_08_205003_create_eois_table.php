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
        Schema::create('eois', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('surname');
            $table->string('first_name');
            $table->string('other_names')->nullable();
            $table->string('nationality');
            $table->string('state_of_origin');
            $table->string('lga');
            $table->date('dob');
            $table->string('sex');
            $table->string('marital_status');
            $table->string('mobile');
            $table->text('residential_address');
            $table->text('business_address')->nullable();
            $table->string('email');
            $table->string('id_type');
            $table->string('passport_photo')->nullable();

            // Next of kin
            $table->string('nok_name');
            $table->string('nok_mobile');
            $table->text('nok_address');
            $table->string('nok_email')->nullable();
            $table->string('nok_id_type')->nullable();

            // Section C
            $table->string('land_category');
            $table->string('payment_option');
            $table->string('agent_name')->nullable();
            $table->string('agent_phone')->nullable();

            // Bank Info
            $table->string('bank_name');
            $table->string('account_number');
            $table->string('account_name');

            // Endorsement
            $table->string('applicant_name');
            $table->string('signature_file')->nullable();
            $table->date('signature_date');
            $table->text('additional_info')->nullable();

            //document attached
            $table->string('id_file')->nullable();
            $table->string('nok_id_file')->nullable();
            $table->string('receiving_manager')->nullable();
$table->date('date_received')->nullable();
$table->string('approval_status')->default('Pending'); 
$table->text('remark')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eois');
    }
};
