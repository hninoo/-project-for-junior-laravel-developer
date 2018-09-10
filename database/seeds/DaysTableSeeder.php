<?php

use Illuminate\Database\Seeder;

class DaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('days')->insert([

        	[
        		'day_name'=>"Mon",
        		'office_time_id'=>1,
        		'time_plan_id'=>1,
        	],
        	[
        		'day_name'=>"Tue",
        		'office_time_id'=>1,
        		'time_plan_id'=>1,
        	
        	],
        	[
        	
        		'day_name'=>"Wed",
        		'office_time_id'=>1,
        		'time_plan_id'=>1,
        	
        	],
        	[
        	
        		'day_name'=>"Thu",
        		'office_time_id'=>1,
        		'time_plan_id'=>1,
        	
        	],
        	[
        	
        		'day_name'=>"Fri",
        		'office_time_id'=>1,
        		'time_plan_id'=>1,
        	
        	]

        ]);
    }
}
