<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->unsignedInteger('created_by');
            $table->unsignedInteger('last_updated_by')->nullable();

            $table->string('reg_no', '25')->unique();
            $table->dateTime('reg_date');
            $table->string('university_reg', '100')->nullable();

            $table->unsignedInteger('faculty')->nullable();
            $table->unsignedInteger('semester')->nullable();
            $table->unsignedInteger('academic_status')->nullable();
            $table->unsignedInteger('batch')->nullable();

            $table->string('first_name', '25');
            $table->string('middle_name', '25')->nullable();
            $table->string('last_name', '25');
            $table->dateTime('date_of_birth');
            $table->string('gender', '10');
            $table->string('blood_group', '10')->nullable();


            $table->string('religion', '25')->nullable();
            $table->string('caste', '25')->nullable();

            $table->string('nationality', '25')->nullable();
            $table->string('mother_tongue', '25')->nullable();
            $table->string('email', '100')->nullable();

            $table->string('extra_info', '100')->nullable();

            $table->text('student_image')->nullable();
            $table->text('student_signature')->nullable();

            $table->boolean('status')->default(1);

            $table->foreign('faculty')->references('id')->on('faculties');
            $table->foreign('semester')->references('id')->on('semesters');
            $table->foreign('academic_status')->references('id')->on('student_statuses');
            $table->foreign('batch')->references('id')->on('student_batches');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
