<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RatingsTableSeeder extends Seeder
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

        for ($i = 0; $i < 20; $i++) {
            $userID = random_int(1, $usersCount);
            $taskID = random_int(1, $tasksCount);
            try {
                DB::table('ratings')->insert(['user_id'=> $userID, 'task_id' => $taskID, 'rating' => random_int(1,5)]);
            }
            catch (Exception $exception) {
            //
            }
        }
    }
}
