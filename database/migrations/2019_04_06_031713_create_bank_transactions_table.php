<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->unsignedInteger('created_by');
            $table->unsignedInteger('last_updated_by')->nullable();

            $table->unsignedInteger('banks_id');
            $table->text('description')->nullable();
            $table->string('deposit_id', '15');

            $table->dateTime('date');
            $table->integer('dr_amt')->default(0);
            $table->integer('cr_amt')->default(0);
            $table->integer('amount')->default(0);

            $table->boolean('status')->default(1);

            $table->foreign('banks_id')->references('id')->on('banks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bank_transactions');
    }
}
