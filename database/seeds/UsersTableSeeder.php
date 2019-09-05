<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	User::truncate();
    	
    	User::create([
	        'name' => 'Md Shohidul Islam',
	        'email' => 'test@example.com',
	        'password' => bcrypt('password'),
	        'remember_token' => str_random(10),
	    ]);

        factory(App\User::class, 10)->create();
    }
}
