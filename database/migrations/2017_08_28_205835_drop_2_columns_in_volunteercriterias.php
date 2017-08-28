<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Drop2ColumnsInVolunteercriterias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('volunteercriterias', function (Blueprint $table) {
            //
            $table->dropColumn('no_of_raters');
            $table->dropColumn('average_rating');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('volunteercriterias', function (Blueprint $table) {
            //
        });
    }
}
