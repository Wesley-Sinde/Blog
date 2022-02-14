<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->unsignedInteger('created_by');
            $table->unsignedInteger('last_updated_by')->nullable();

            $table->string('invoice_no', '15');
            $table->unsignedInteger('vendors_id');
            $table->dateTime('purchase_date');
            $table->integer('grand_total_amount');
            $table->integer('total_discount');
            $table->text('purchase_details');

            $table->boolean('status')->default(1);

            $table->foreign('vendors_id')->references('id')->on('vendors');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchases');
    }
}
