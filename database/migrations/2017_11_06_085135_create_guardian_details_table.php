<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuardianDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guardian_details', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->unsignedInteger('created_by');
            $table->unsignedInteger('last_updated_by')->nullable();

            $table->string('guardian_first_name', '15');
            $table->string('guardian_middle_name', '15')->nullable();
            $table->string('guardian_last_name', '15');
            $table->string('guardian_eligibility', '50')->nullable();
            $table->string('guardian_occupation', '50')->nullable();
            $table->string('guardian_office', '100')->nullable();
            $table->string('guardian_office_number', '15')->nullable();
            $table->string('guardian_residence_number', '15')->nullable();
            $table->string('guardian_mobile_1', '15')->nullable();
            $table->string('guardian_mobile_2', '15')->nullable();
            $table->string('guardian_email', '100')->nullable();
            $table->string('guardian_relation', '50');
            $table->string('guardian_address', '100')->nullable();

            $table->text('guardian_image')->nullable();
            $table->boolean('status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guardian_details');
    }
}
