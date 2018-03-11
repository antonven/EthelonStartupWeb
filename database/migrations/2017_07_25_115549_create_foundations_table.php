<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoundationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foundations', function (Blueprint $table) {
            
            $table->string('foundation_id')->primary();
            $table->string('user_id');
            $table->string('image_url')->nullable();
            $table->string('description')->nullable();
            $table->string('location')->nullable();
            $table->integer('long')->nullable();
            $table->string('email')->nullable();
            $table->integer('lat')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('website_url')->nullable();
            $table->boolean('verified')->default(false);
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
        Schema::dropIfExists('foundations');
    }
}
