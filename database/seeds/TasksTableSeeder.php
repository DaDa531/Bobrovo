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
        /* náhodné úlohy

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
        */

        $file = File::get("database/seeds/data/tasks.json");
        $file = json_decode($file);

        foreach ($file as $row) {
            $task = new Task ([
                "title" => $row->title,
                "question" => $row->question,
                "a" => $row->a,
                "b" => $row->b,
                "c" => $row->c,
                "d" => $row->d,
                "answer" => $row->answer,
                "type" => $row->type,
                "description_student" => $row->description_student,
                "description_teacher" => $row->description_teacher,
                "created_by" => 1,
                "public" => true
            ]);

            $task->save();
        }
    }
}
