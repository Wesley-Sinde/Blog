<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->unsignedInteger('created_by');
            $table->unsignedInteger('last_updated_by')->nullable();

            $table->string('code', '15')->unique()->nullable();
            $table->string('name', 100);
            $table->unsignedInteger('category_id')->nullable()->default(0);
            $table->unsignedInteger('sub_category_id')->nullable()->default(0);

            $table->string('warranty', '15')->nullable();

            $table->text('product_image')->nullable();

            $table->text('description')->nullable();
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
        Schema::dropIfExists('products');
    }
}
