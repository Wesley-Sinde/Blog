<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSemestersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('semesters', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->unsignedInteger('created_by');
            $table->unsignedInteger('last_updated_by')->nullable();

            $table->string('semester', '50')->unique();
            $table->string('slug', '50')->unique();
            $table->unsignedInteger('staff_id')->nullable();
            $table->unsignedInteger('gradingType_id')->nullable();

            $table->boolean('status')->default(1);

            //$table->foreign('staff_id')->references('id')->on('staff');
            //$table->foreign('gradingType_id')->references('id')->on('grading_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('semesters');
    }
}
