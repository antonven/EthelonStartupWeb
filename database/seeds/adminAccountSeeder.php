<?php

use Illuminate\Database\Seeder;


class adminAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$user_id = substr(sha1(mt_rand().microtime()), mt_rand(0,35),7);
        $time = microtime(true);
        $api_token = $user_id.$time;
        DB::table('users')->insert([
        	"user_id" => "3th3l0n1",
        	"name" => "ethelon admin",
        	"email" => "admin@ethelon.com",
        	"password" => bcrypt('ethelon123'),
        	"role" => "admin",
        	"api_token" => $api_token,
        	"verified" => 1
        	]);
    }
}
