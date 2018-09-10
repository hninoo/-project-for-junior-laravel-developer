<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([

        		[
        		'role_name'=>"Admin",
        		],
        		[
        		'role_name'=>"Manager",
        		],
        		[
        		'role_name'=>"Senior",
        		],
        		[
        		'role_name'=>"Junior",
        		],
        		[
        		'role_name'=>"Intern",
        		],
        ]);
    }
}
