<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('App\Comment');

        for($i = 1; $i <= 10; $i ++){
        	DB::table('comments')->insert([
        		'user_id' => $faker->numberBetween($min = 1, $max = 20),
        		'meet_id' => $faker->numberBetween($min = 1, $max = 25),
        		'comment' => $faker->sentence(),
        		'deleted' => 0,
        		'updated_at' => \Carbon\Carbon::now(),
        		'created_at' => \Carbon\Carbon::now(),
        		]);
        }
    }
}
