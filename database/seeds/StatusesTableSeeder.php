<?php

use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert([

        	[
        		'status_name'=>"late",
        	],
        	[
        		'status_name'=>"absent",
        	],
        	[
        		'status_name'=>"full day leave",

        	],
        	
        	[
        	
        		'status_name'=>"half day leave",
        	
        	],
        	[
        	
        		'status_name'=>"intime",
        	
        	],
        	[
        	
        		'status_name'=>"early checkout",
        	
        	],

        	[
        	
        		'status_name'=>"ot",
 
        	]

        ]);
    }
}
