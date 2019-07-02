<?php

use App\User;
use App\Task;
use Illuminate\Database\Seeder;

class RatingsTableSeeder extends Seeder
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

        for ($i = 0; $i < 20; $i++) {
            $task = $tasksIDs->random();
            $user = $userIDs->random();
            try {
                DB::table('ratings')->insert(['user_id'=> $user, 'task_id' => $task, 'rating' => random_int(1,5)]);
            }
            catch (Exception $exception) {
            //
            }
        }
    }
}
