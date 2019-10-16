<?php

namespace App\Http\Controllers;

use App\Task;
use App\Topic;
use App\Category;
use App\User;
use App\Test;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTask;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

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
        $filter = Session::get('tasksFilter');
        if ($filter) {
            $category = !empty($filter['category']) ? $filter['category'] : null;
            $topic = !empty($filter['topic']) ? $filter['topic'] : null;
            $type = !empty($filter['type']) ? $filter['type'] : null;
            $tasks = Task::ofCategories($category)->ofTopics($topic)->ofTypes($type)->get();
        }
        else {
            $tasks = Task::all();
        }

        $test = Session::get('test');

        $tests = null;
        if (!isset($test))
            $tests = Test::getTests()->get();
        else
            $test = Test::find($test);

        return view('tasks.index', [
            'tasks' => $tasks,
            'test' => $test,
            'tests' => $tests,
            'topics' => Topic::all(),
            'categories' => Category::all(),
            'filter' => $filter
        ]);
    }

    /**
     * Set the tasks filter
     *
     * @return Response
     */
    public function filter(Request $request){

        $filter = array(
            'category' => $request->input('category'),
            'topic' => $request->input('topic'),
            'type' => $request->input('type')
        );

        Session::put('tasksFilter', $filter);

        return redirect()->route('tasks');
    }

    /**
     * Delete task filter.
     *
     * @return Response
     */
    public function resetFilter(Request $request){

        Session::put('tasksFilter', null);

        return redirect()->route('tasks');
    }

    /**
     * Show given task.
     *
     * @param  Task  $task
     * @return Response
     */
    public function show(Task $task)
    {
        return view('tasks.show', [
            'task' => $task,
            'topics' => $task->topics()->get(),
            'categories' => $task->categories()->pluck('name'),
            'rating' => $task->averageRating(),
            'comments' => $task->comments()->get()
        ]);
    }

    /**
     * Create new task.
     *
     * @return Response
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
     * @param  Task $task
     * @return Response
     */
    public function edit(Task $task)
    {
        if (!$task->authIsMyAuthor())
            return back();

        $topics = Topic::all();
        $categories = Category::all();
        return view('tasks.edit', [
            'task' => $task,
            'topics' => $topics,
            'categories' => $categories,
            'mytopics' => $task->topics()->get(),
            'mycategories' => $task->categories()->get()
        ]);
    }

    /**
    /**
     * Show list of my tasks.
     *
     * @return Response
     */
    public function mytasks()
    {
        $tasks = Task::getTasks()->paginate(10);
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

        //TO DO - ak zadám nejaku podtému (t.j. má parent_id), automaticky sa pridá aj parent
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  Task $task
     * @return Response
     */
    public function destroy(Task $task)
    {

        //da sa zmazat, len ak nie je v ziadnom teste a patri tomu, ktore je prihlaseny

        if (!$task->authIsMyAuthor())
            return back();

        $task->delete();

        return redirect()->route('tasks.my');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreTask $request
     * @param Task $task
     * @return Response
     */
    public function update(StoreTask $request, Task $task)
    {
        $task->update([
            'title' => $request->title,
            'question' => $request->question,
            'a' => $request->a,
            'b' => $request->b,
            'c' => $request->c,
            'd' => $request->d,
            'answer' => $request->answer,
            //'type' => '1',
            'description_student' => ($request->description_student == null ? '' : $request->description_student),
            'description_teacher' => ($request->description_teacher == null ? '' : $request->description_teacher)
            //'public' => '1',
        ]);

        if ($request->topics != null) {
            $task->topics()->sync($request->topics);
        }

        if ($request->categories != null) {
            $task->categories()->sync($request->categories);
        }

        return redirect()->route('tasks.show', $task->id)->with([
            'success' => 'Úloha '. $task->title . ' bola zmenená!'
        ]);
    }
}