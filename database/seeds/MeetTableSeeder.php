<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class MeetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('App\Meet');

        for($i = 1; $i <= 20; $i ++){
        	DB::table('meets')->insert([
        		'user_id' => $faker->numberBetween($min = 1, $max = 20),
        		'title' => $faker->sentence(),
        		'meet_date' => $faker->dateTimeThisYear($max = 'now', $timezone = date_default_timezone_get()),
        		'location' => $faker->streetName,
        		'lat' => $faker->latitude($min = -90, $max = 90),
        		'lng' => $faker->longitude($min = -180, $max = 180),
        		'description' => implode($faker->paragraphs(5)),
        		'deleted' => 0,
        		'updated_at' => \Carbon\Carbon::now(),
        		'created_at' => \Carbon\Carbon::now(),
        		]);
        }


    }
}
