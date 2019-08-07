<?php

use App\Test;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usersCount = DB::table('users')->count();
        $faker = Faker::create();
        for($i = 0; $i < 20; $i++){
            $test = new Test([
                'name' => $faker->word,
                'description' => $faker->paragraph,
                'teacher_id' => $faker->numberBetween(1, $usersCount),
                'available_description' => $faker->numberBetween(0, 1),
                'mix_questions' => $faker->numberBetween(0, 1),
                'available_answers' => $faker->numberBetween(0, 1),
                'public' => 1
            ]);

            $test->save();
        }
    }
}
