<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->unsignedInteger('created_by');
            $table->unsignedInteger('last_updated_by')->nullable();

            $table->string('reg_no', '15')->unique()->nullable();
            $table->string('name', '50');
            $table->string('address', '100')->nullable();
            $table->string('tel', '15')->nullable();
            $table->string('mobile_1', '10')->nullable();
            $table->string('mobile_2', '10')->nullable();
            $table->string('email', '100')->nullable();

            $table->text('extra_info')->nullable();

            $table->text('customer_image')->nullable();

            $table->unsignedInteger('customer_status')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
