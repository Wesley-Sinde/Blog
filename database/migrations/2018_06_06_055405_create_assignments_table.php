<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->unsignedInteger('created_by');
            $table->unsignedInteger('last_updated_by')->nullable();

            $table->unsignedInteger('years_id');
            $table->unsignedInteger('semesters_id');
            $table->unsignedInteger('subjects_id');
            $table->dateTime('publish_date');
            $table->dateTime('end_date');

            $table->string('title', '100');
            $table->text('description');
            $table->text('file')->nullable();
            $table->boolean('status')->default(0);

            $table->foreign('years_id')->references('id')->on('years');
            $table->foreign('semesters_id')->references('id')->on('semesters');
            $table->foreign('subjects_id')->references('id')->on('subjects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assignments');
    }
}
