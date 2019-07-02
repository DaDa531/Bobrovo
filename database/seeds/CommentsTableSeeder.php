<?php

use App\User;
use App\Task;
use App\Comment;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userIDs = User::getIDs();
        $tasksIDs = Task::getIDs();
        $faker = Faker::Create();

        for ($i = 0; $i < 20; $i++) {
            $comment = new Comment([
                'user_id' => $userIDs->random(),
                'task_id' => $tasksIDs->random(),
                'comment' => $faker->paragraph
            ]);
            $comment->save();
        }
    }
}
