<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeMigrationAddColumnsToVolunteeractivity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('volunteeractivities', function (Blueprint $table) {
            //

            $table->time('timeIn');
            $table->boolean('volunteerTimedIn')->default(false);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('volunteeractivities', function (Blueprint $table) {
            //
        });
    }
}
