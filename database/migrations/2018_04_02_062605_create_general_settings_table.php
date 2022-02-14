<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeneralSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->unsignedInteger('created_by');
            $table->unsignedInteger('last_updated_by')->nullable();

            $table->string('institute', '100');
            $table->string('salogan', '100')->nullable();
            $table->text('copyright')->nullable();
            $table->text('address')->nullable();
            $table->string('phone', '100')->nullable();
            $table->string('email', '100')->nullable();
            $table->string('website', '100')->nullable();

            //Images
            $table->text('favicon')->nullable();
            $table->text('logo')->nullable();

            $table->text('print_header')->nullable();
            $table->text('print_footer')->nullable();


            $table->string('facebook', '100')->nullable();
            $table->string('twitter', '100')->nullable();
            $table->string('linkedIn', '100')->nullable();
            $table->string('youtube', '100')->nullable();
            $table->string('googlePlus', '100')->nullable();
            $table->string('instagram', '100')->nullable();
            $table->string('whatsApp', '100')->nullable();
            $table->string('skype', '100')->nullable();
            $table->string('pinterest', '100')->nullable();
            $table->string('wordpress', '100')->nullable();


            $table->unsignedInteger('time_zones_id')->nullable();

            $table->boolean('quick_menu')->default(1);
            $table->boolean('public_registration')->default(1);

            $table->boolean('front_desk')->default(1);
            $table->boolean('student_staff')->default(1);
            $table->boolean('account')->default(1);
            $table->boolean('inventory')->default(1);
            $table->boolean('library')->default(1);
            $table->boolean('attendance')->default(1);
            $table->boolean('exam')->default(1);
            $table->boolean('certificate')->default(1);
            $table->boolean('hostel')->default(1);
            $table->boolean('transport')->default(1);
            $table->boolean('assignment')->default(1);
            $table->boolean('upload_download')->default(1);
            $table->boolean('meeting')->default(1);
            $table->boolean('alert')->default(1);
            $table->boolean('academic')->default(1);
            $table->boolean('help')->default(1);

            $table->boolean('status')->default(1);

            $table->foreign('time_zones_id')->references('id')->on('time_zones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('general_settings');
    }
}
