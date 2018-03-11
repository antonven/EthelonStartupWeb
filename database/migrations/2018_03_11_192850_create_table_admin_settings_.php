<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAdminSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('activityPresetPoints');
            $table->integer('activityHoursRenderedMultiplier');
            $table->integer('activityPointsPerRating');
            $table->integer('newbieGauge');
            $table->integer('explorerGauge');
            $table->integer('expertGauge');
            $table->integer('legendGauge');
            $table->integer('agePercentage');
            $table->integer('pointPercentage');
            $table->integer('ageTotal');
            $table->integer('pointTotal');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
