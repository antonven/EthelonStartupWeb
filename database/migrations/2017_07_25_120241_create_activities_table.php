<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->string('activity_id')->primary();
            $table->string('foundation_id');
            $table->string('name');
            $table->string('image_url')->nullable();
            $table->string('imageQr_url')->nullable();
            $table->string('description')->nullable();
            $table->string('location')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->date('date')->nullable();
            $table->integer('group')->nullable();
            $table->integer('long')->nullable();
            $table->integer('lat')->nullable();
            $table->integer('points_equivalent');
            $table->boolean('status')->default(false);
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
        Schema::dropIfExists('activities');
    }
}
