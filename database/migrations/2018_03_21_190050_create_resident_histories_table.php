<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResidentHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resident_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->unsignedInteger('created_by');
            $table->unsignedInteger('last_updated_by')->nullable();

            $table->unsignedInteger('years_id');
            $table->unsignedInteger('hostels_id');
            $table->unsignedInteger('rooms_id')->nullable();
            $table->unsignedInteger('beds_id')->nullable();
            $table->unsignedInteger('residents_id');
            $table->text('history_type');

            $table->boolean('status')->default(1);

            $table->foreign('years_id')->references('id')->on('years');
            $table->foreign('hostels_id')->references('id')->on('hostels');
            $table->foreign('rooms_id')->references('id')->on('rooms');
            $table->foreign('beds_id')->references('id')->on('beds');
            $table->foreign('residents_id')->references('id')->on('residents');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resident_histories');
    }
}
