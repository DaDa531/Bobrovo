<?php

use App\Task;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $possibilities = collect(['a', 'b', 'c', 'd']);
        $faker = Faker::Create();
        for ($i = 0; $i < 30; $i++) {
            $task = new Task([
                'title' => $faker->word,
                'question' => $faker->paragraph,
                'a' => $faker->word,
                'b' => $faker->word,
                'c' => $faker->word,
                'd' => $faker->word,
                'answer' => $possibilities->random(),
                'type' => $faker->numberBetween(1, 3),
                'description_student' => $faker->paragraph,
                'description_teacher' => $faker->paragraph,
                'created_by' => 1,
                'public' => true
            ]);

            $task->save();
        }
    }
}
