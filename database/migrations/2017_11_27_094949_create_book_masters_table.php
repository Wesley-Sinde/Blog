<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_masters', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->unsignedInteger('created_by');
            $table->unsignedInteger('last_updated_by')->nullable();

            $table->unsignedInteger('categories')->nullable();

            $table->string('isbn_number', '25')->nullable();
            $table->string('code', '15');
            $table->string('title', '100');
            $table->string('sub_title', '100')->nullable();
            $table->text('image')->nullable();
            $table->string('language', '100')->nullable();
            $table->string('editor', '100')->nullable();
            $table->string('edition', '100')->nullable();
            $table->string('edition_year', '100')->nullable();
            $table->string('publisher', '100')->nullable();
            $table->string('publish_year', '100')->nullable();
            $table->string('series', '100')->nullable();
            $table->string('author', '100');
            $table->string('rack_location', '100')->nullable();
            $table->string('price', '100');
            $table->string('total_pages', '100')->nullable();
            $table->string('source', '100')->nullable();
            $table->string('notes', '100')->nullable();

            $table->boolean('status')->default(1);

            $table->foreign('categories')->references('id')->on('book_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_masters');
    }
}
