<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attends', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('meet_id');
            $table->tinyInteger('attending');
            $table->tinyInteger('deleted')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
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
