<?php

namespace App\Http\Controllers;

use App\Task;
use App\Topic;
use App\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * TeacherController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $tasks = Task::paginate(10);
        return view('tasks.index', [
            'tasks' => $tasks
        ]);
    }


    /**
     * Show given task.
     *
     * @param  Tasks  $task
     * @return View
     */
    public function show(Task $task)
    {
        return view('tasks.show', [
            'task' => $task,
            'topics' => $task->topics()->get(),
            'categories' => $task->categories()->get(),
            'rating' => $task->averageRating(),
            'comments' => $task->comments()->get()
        ]);
    }

    /**
     * Create new task.
     *
     * @return View
     */
    public function create()
    {
        $topics = Topic::all();
        return view('tasks.create', [
            'topics' => $topics,
        ]);
    }

    /**
     * Edit given task.
     *
     * @param  Tasks  $task
     * @return View
     */
    public function edit(Task $task)
    {
        return view('tasks.edit', [
            'task' => $task
        ]);
    }

    /**
     * Show list of my tasks.
     *
     * @return View
     */
    public function mytasks()
    {
        $tasks = auth()->user()->tasks()->paginate(10);
        return view('tasks.my', [
            'tasks' => $tasks
        ]);
    }


}