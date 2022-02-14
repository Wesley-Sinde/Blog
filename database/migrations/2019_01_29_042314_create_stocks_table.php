<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()//'created_by', 'last_updated_by', 'products_id', 'transaction_type','qty_in', 'qty_out', 'status'
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->unsignedInteger('created_by');
            $table->unsignedInteger('last_updated_by')->nullable();

            $table->unsignedInteger('products_id');
            $table->string('transaction_type', '25')->nullable();
            $table->dateTime('date');
            $table->integer('qty_in')->nullable()->default(0);
            $table->integer('qty_out')->nullable()->default(0);

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
        Schema::dropIfExists('stocks');
    }
}
