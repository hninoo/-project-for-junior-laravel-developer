<?php

use Illuminate\Database\Seeder;

class Office_timesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('office_times')->insert([

        		'start_time'=>'09:00:00',
        		'end_time'=>'05:00:00',
        		'allow_time'=>'00:15:00',
        	]);
    }
}
