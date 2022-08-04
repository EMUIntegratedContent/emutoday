<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EmailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker\Factory::create();
      DB::table('emails')->insert([
        'title' => $faker->name,
        'frequency' => $faker->randomDigitNotNull,
        'send_at' => $faker->dateTimeThisMonth,
        'stop_at' => $faker->dateTimeThisMonth,
      ]);
    }
}
