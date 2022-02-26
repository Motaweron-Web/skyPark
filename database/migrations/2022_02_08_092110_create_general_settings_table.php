<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();

            $table->bigInteger('capacity')->default(1250)->nullable();
            $table->string('logo',500)->nullable();
            $table->string('title',500)->nullable();
            $table->text('terms');
            $table->text('about');
            $table->text('address');
            $table->string('phone')->nullable();
            $table->string('Team_phone')->nullable();
            $table->string('group_organization_phone')->nullable();
            $table->string('info_email')->nullable();
            $table->string('sales_email')->nullable();
            $table->string('twitter')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('snap')->nullable();
            $table->timestamps();
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
