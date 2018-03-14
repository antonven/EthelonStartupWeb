<?php

use Illuminate\Database\Seeder;
use App\Skill;
class skillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Skill::create([
        	"skill" => "Environmental"
        ]);

        Skill::create([
        	"skill" => "Livelihood"
        ]);

        Skill::create([
        	"skill" => "Education"
        ]);

        Skill::create([
        	"skill" => "Charity"
        ]);

        Skill::create([
        	"skill" => "Sports"
        ]);

        Skill::create([
        	"skill" => "Culinary"
        ]);

        Skill::create([
        	"skill" => "Medical"
        ]);

        Skill::create([
        	"skill" => "Arts"
        ]);
    }
}
