<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parent_details', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->unsignedInteger('created_by');
            $table->unsignedInteger('last_updated_by')->nullable();

            $table->unsignedInteger('students_id');
            $table->foreign('students_id')->references('id')->on('students');
            $table->string('grandfather_first_name', '15')->nullable();
            $table->string('grandfather_middle_name', '15')->nullable();
            $table->string('grandfather_last_name', '15')->nullable();

            $table->string('father_first_name', '15');
            $table->string('father_middle_name', '15')->nullable();
            $table->string('father_last_name', '15');
            $table->string('father_eligibility', '50')->nullable();
            $table->string('father_occupation', '50')->nullable();
            $table->string('father_office', '100')->nullable();
            $table->string('father_office_number', '15')->nullable();
            $table->string('father_residence_number', '15')->nullable();
            $table->string('father_mobile_1', '15')->nullable();
            $table->string('father_mobile_2', '15')->nullable();
            $table->string('father_email', '100')->nullable();

            $table->string('mother_first_name', '15');
            $table->string('mother_middle_name', '15')->nullable();
            $table->string('mother_last_name', '15');
            $table->string('mother_eligibility', '50')->nullable();
            $table->string('mother_occupation', '50')->nullable();
            $table->string('mother_office', '100')->nullable();
            $table->string('mother_office_number', '15')->nullable();
            $table->string('mother_residence_number', '15')->nullable();
            $table->string('mother_mobile_1', '15')->nullable();
            $table->string('mother_mobile_2', '15')->nullable();
            $table->string('mother_email', '100')->nullable();

            $table->text('father_image')->nullable();
            $table->text('mother_image')->nullable();
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
        Schema::dropIfExists('parent_details');
    }
}
