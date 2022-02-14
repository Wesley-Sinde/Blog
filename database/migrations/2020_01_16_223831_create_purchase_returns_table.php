<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_returns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->unsignedInteger('created_by');
            $table->unsignedInteger('last_updated_by')->nullable();

            $table->dateTime('purchase_date');
            $table->string('invoice_no', '15');
            $table->unsignedInteger('purchase_id');
            $table->unsignedInteger('vendors_id');
            $table->unsignedInteger('purchase_detail_id');
            $table->unsignedInteger('products_id');
            $table->integer('qty');
            $table->integer('rate');
            $table->integer('total_amount');

            $table->boolean('status')->default(1);

            $table->foreign('vendors_id')->references('id')->on('vendors');
            $table->foreign('products_id')->references('id')->on('products');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_returns');
    }
}
