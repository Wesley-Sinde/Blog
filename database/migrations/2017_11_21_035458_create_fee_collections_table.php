<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeeCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fee_collections', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->unsignedInteger('created_by');
            $table->unsignedInteger('last_updated_by')->nullable();

            $table->unsignedInteger('students_id');
            $table->unsignedInteger('fee_masters_id');
            $table->dateTime('date');
            $table->integer('paid_amount');
            $table->integer('discount')->nullable();
            $table->integer('fine')->nullable();
            $table->string('payment_mode', '15');
            $table->string('note', '100')->nullable();
            $table->text('response')->nullable();
            $table->boolean('status')->default(1);

            $table->foreign('students_id')->references('id')->on('students');
            $table->foreign('fee_masters_id')->references('id')->on('fee_masters');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fee_collections');
    }
}
