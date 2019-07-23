<?php

namespace App\Http\Controllers;

use App\Task;
use App\Topic;
use App\Category;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTask;

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
        $categories = Category::all();
        return view('tasks.create', [
            'topics' => $topics,
            'categories' => $categories
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


    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTask $request
     * @return Response
     */
    public function store(StoreTask $request)
    {
        $task = Task::create([
            'title' => $request->title,
            'question' => $request->question,
            'a' => $request->a,
            'b' => $request->b,
            'c' => $request->c,
            'd' => $request->d,
            'answer' => $request->answer,
            'type' => '1',
            'description_student' => ($request->description_student == '' ? '' : $request->description_student),
            'description_teacher' => ($request->description_teacher == '' ? '' : $request->description_teacher),
            'public' => '1',
            'created_by' => auth()->user()->id
        ]);

        if ($request->topics != null) {
            $task->topics()->attach($request->topics);
        }

        if ($request->categories != null) {
            $task->categories()->attach($request->categories);
        }

        return redirect()->route('tasks.create')->with([
            'success' => 'Úloha '. $task->title . ' bola uložená!'
        ]);
    }
}