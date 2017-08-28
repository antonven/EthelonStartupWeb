<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVolunteercriteriapointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('volunteercriteriapoints', function (Blueprint $table) {
            $table->increments('id');
            $table->string('activity_id');
            $table->string('volunteer_id');
            $table->string('criteria_name');
            $table->string('total_points');
            $table->integer('no_of_raters');
            $table->integer('average_points');
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
        Schema::dropIfExists('volunteercriteriapoints');
    }
}
