<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVolunteercriteriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('volunteercriterias', function (Blueprint $table) {

            $table->increments('id');
            $table->string('activitygroups_id');
            $table->string('volunteer_id');
            $table->integer('average_rating');
            $table->string('actvity_id');
            $table->string('criteria_name');
            $table->integer('no_of_raters');
            $table->integer('sum_of_rating');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('volunteercriterias');
    }
}
