<?php

use App\Task;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskTopicTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tasks = Task::all();
        $topicsCount = DB::table('topics')->count();

       //najskôr každej úlohe priradím aspoň jednu tému
       foreach ($tasks as $task)
            $task->topics()->attach(random_int(1, $topicsCount));


        //potom náhodným úlohám priradím ďalšiu tému

       $max = random_int(5,$tasks->count());
       for ($i = 0; $i < $max; $i++) {
           $task = $tasks->random();
           try {
               $task->topics()->attach(random_int(1, $topicsCount));
           } catch (Exception $exception) {
               //
           }
       }
    }
}
