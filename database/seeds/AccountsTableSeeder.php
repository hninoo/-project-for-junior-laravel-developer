<?php

use Illuminate\Database\Seeder;

class AccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accounts')->insert([
        		'account_name'=>"Hnin Oo Wai Lwin",
        		'email'=>"hninoo@gmail.com",
        		'password'=>bcrypt("hninoo"),
        		'phone'=>"0927867689",
        		'address'=>"south dagon",
        		'nrc'=>"12/676763",
        		'dob'=>"1995-12-19",
        		'active'=>1,
        	]);
    }
}
