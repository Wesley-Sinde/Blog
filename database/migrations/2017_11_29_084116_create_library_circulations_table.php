<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLibraryCirculationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('library_circulations', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->unsignedInteger('created_by');
            $table->unsignedInteger('last_updated_by')->nullable();

            $table->string('user_type', '100')->unique();
            $table->string('slug', '100')->unique();
            $table->string('code_prefix', '50')->unique();
            $table->unsignedInteger('issue_limit_days')->nullable();
            $table->unsignedInteger('issue_limit_books')->nullable();
            $table->unsignedInteger('fine_per_day')->nullable();
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
        Schema::dropIfExists('library_circulations');
    }
}
