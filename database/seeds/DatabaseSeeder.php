<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$user = new User;
    	
    	$user->username = 'admin';
    	$user->password = Hash::make('secret');
    	$user->tinyintIdentifier = 1;

    	$user->save();
    }
}
