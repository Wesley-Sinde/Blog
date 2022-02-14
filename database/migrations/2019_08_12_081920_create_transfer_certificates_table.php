<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransferCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfer_certificates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->unsignedInteger('created_by');
            $table->unsignedInteger('last_updated_by')->nullable();

            $table->unsignedInteger('students_id')->unique();
            $table->date('date_of_issue');
            $table->date('date_of_leaving');
            $table->string('tc_num')->unique();
            $table->text('leaving_time_class');
            $table->text('qualified_to_promote');
            $table->string('paid_fee_status');
            $table->string('character');
            $table->text('ref_text')->nullable();

            $table->boolean('status')->default(1);

            $table->foreign('students_id')->references('id')->on('students');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transfer_certificates');
    }
}

