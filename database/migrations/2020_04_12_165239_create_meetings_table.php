<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->unsignedInteger('created_by');
            $table->unsignedInteger('last_updated_by')->nullable();

            $table->unsignedInteger('semesters_id');
            $table->unsignedInteger('subjects_id');

            $table->string('meeting_id');
            $table->string('topic');

            $table->string('start_time');
            $table->integer('duration');
            $table->string('timezone');

            $table->text('start_url');
            $table->string('join_url');

            $table->string('history_type');
            $table->text('ref_text')->nullable();

            $table->boolean('status')->default(0);

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
        Schema::dropIfExists('meetings');
    }
}
