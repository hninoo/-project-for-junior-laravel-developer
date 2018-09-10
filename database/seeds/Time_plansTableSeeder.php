<?php

use Illuminate\Database\Seeder;

class Time_plansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('time_plans')->insert([
        		'time_plan_name'=>"Weekday Plan",
        	]);
    }
}
