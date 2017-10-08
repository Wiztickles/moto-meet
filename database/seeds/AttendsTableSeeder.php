<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AttendsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('App\Attend');

        for($i = 1; $i <= 20; $i ++){
        	DB::table('attends')->insert([
        		'user_id' => $faker->numberBetween($min = 1, $max = 20),
        		'meet_id' => $faker->numberBetween($min = 1, $max = 25),
        		'attending' => $faker->numberBetween($min = 0, $max = 1),
        		'deleted' => 0,
        		'updated_at' => \Carbon\Carbon::now(),
        		'created_at' => \Carbon\Carbon::now(),
        		]);
        }

    }
}
