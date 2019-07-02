<?php

use App\Task;
use App\Topic;
use Illuminate\Database\Seeder;

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
        $topicIDs = Topic::getIDs();

       //najskôr každej úlohe priradím aspoň jednu tému
       foreach ($tasks as $task)
            $task->topics()->attach($topicIDs->random());


        //potom náhodným úlohám priradím ďalšiu tému

       $max = random_int(5,$tasks->count());
       for ($i = 0; $i < $max; $i++) {
           $task = $tasks->random();
           try {
               $task->topics()->attach($topicIDs->random());
           } catch (Exception $exception) {
               //
           }
       }
    }
}
