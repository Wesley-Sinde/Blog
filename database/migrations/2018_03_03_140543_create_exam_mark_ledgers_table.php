<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamMarkLedgersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_mark_ledgers', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->unsignedInteger('created_by');
            $table->unsignedInteger('last_updated_by')->nullable();

            $table->unsignedInteger('exam_schedule_id');
            $table->unsignedInteger('students_id');

            $table->integer('obtain_mark_theory')->default(0);
            $table->boolean('absent_theory')->default(0);

            $table->integer('obtain_mark_practical')->default(0);
            $table->boolean('absent_practical')->default(0);

            $table->unsignedInteger('sorting_order');
            $table->boolean('status')->default(1);

            $table->foreign('students_id')->references('id')->on('students');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_mark_ledgers');
    }
}
