<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('residents', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->unsignedInteger('created_by');
            $table->unsignedInteger('last_updated_by')->nullable();

            $table->unsignedInteger('hostels_id');
            $table->unsignedInteger('rooms_id')->nullable();
            $table->unsignedInteger('beds_id')->nullable();
            
             $table->unsignedInteger('user_type');
            $table->unsignedInteger('member_id');

            $table->dateTime('register_date');
            $table->dateTime('leave_date')->nullable();

            $table->boolean('status')->default(1);

            $table->foreign('hostels_id')->references('id')->on('hostels');
            $table->foreign('rooms_id')->references('id')->on('rooms');
            $table->foreign('beds_id')->references('id')->on('beds');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('residents');
    }
}
