<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('App\User');

        for($i = 1; $i <= 20; $i ++){
        	DB::table('users')->insert([
        		'username' => $faker->userName,
        		'email' => $faker->email,
        		'motorcycle' => $faker->streetName,
        		'city' => $faker->city,
        		'password' => $faker->password,
        		'bio' => implode($faker->paragraphs(5)),
        		'admin' => 0,
        		'updated_at' => \Carbon\Carbon::now(),
        		'created_at' => \Carbon\Carbon::now(),
        		]);
        }
    }
}
