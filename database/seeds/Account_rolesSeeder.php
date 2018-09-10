<?php

use Illuminate\Database\Seeder;

class Account_rolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('account_roles')->insert([
        		'account_id'=>1,
        		'role_id'=>1,
                'time_plan_id'=>1,
        	]);
    }
}
