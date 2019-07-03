<?php

use App\Comment;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usersCount = DB::table('users')->count();
        $tasksCount = DB::table('tasks')->count();
        $faker = Faker::Create();

        for ($i = 0; $i < 20; $i++) {
            $comment = new Comment([
                'user_id' => $faker->numberBetween(1, $usersCount),
                'task_id' => $faker->numberBetween(1, $tasksCount),
                'comment' => $faker->paragraph
            ]);
            $comment->save();
        }
    }
}
