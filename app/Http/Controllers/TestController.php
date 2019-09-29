<?php

namespace App\Http\Controllers;

use App\Test;
use App\Group;
use App\Category;
use App\Topic;
use App\Task;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTest;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;

class TestController extends Controller
{
    /**
     * TestController constructor.
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
        $tests = Test::getTests()->get();
        return view('test.index', [
            'tests' => $tests
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('test.create', []);
    }

    /**
     * Display the specified resource.
     *
     * @param Test $test
     * @return Response
     */
    public function show(Test $test)
    {
        if (!$test->authIsMyTeacher())
            return back();

        return view('test.show', [
            'test' => $test,
            'tasks' => $test->tasks()->get(),
            'group_assignments' => collect($test->assignments()->get()->load(['group'])),
            'time' => Carbon::now('Europe/Paris')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTest $request
     * @return Response
     */
    public function store(StoreTest $request)
    {
        // Doplnit cast, keby to vytvorenie zlyhalo !!!
        $test = Test::create([
            'name' => $request->name,
            'description' => $request->description != null ? $request->description : '',
            'teacher_id' => auth()->user()->id,
            'available_description' => $request->available_description != null ? 1 : 0,
            'public' => 0
        ]);

        return redirect()->route('tasks', $test->id)->with([
            'success' => 'Test bol úspešne vytvorený!'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Test $test
     * @return Response
     */
    public function edit(Test $test)
    {
        if (!$test->authIsMyTeacher())
            return back();

        return view('test.edit', [
            'test' => $test
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreTest $request
     * @param Test $test
     * @return Response
     */
    public function update(StoreTest $request, Test $test)
    {
        $test->update([
            'name' => $request->name,
            'description' => ($request->description === null) ? '' : ($request->description),
            'available_description' => ($request->available_description == null ? 0 : 1)
        ]);

        return redirect()->route('test.show', $test->id)->with([
            'success' => 'Údaje o teste boli úspešne zmenené!'
        ]);
    }

    /**
     * Display tasks to select.
     *
     * @param Test $test
     * @return Response
     */
    public function selectTasks(Test $test)
    {
        if (!$test->authIsMyTeacher())
            return back();

        $categories = Category::all();
        $topics = Topic::all();
        $selectedtasks = $test->tasks();
        return view('test.selecttasks', [
            'test' => $test,
            'categories' => $categories,
            'topics' => $topics,
            'selectedtasks' => $selectedtasks->get(),
            'alltasks' => Task::getTasksExcept( $selectedtasks->pluck('id')->toArray())->get()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Test $task
     * @return Response
     */
    public function destroy(Test $test)
    {
        //da sa zmazat, len ak ho este nikto neriešil

        if (!$test->authIsMyAuthor())
            return back();

        $test->delete();

        return redirect()->route('test');
    }

    /**
     * Add selected tasks to a test.
     *
     * @param Request $request
     * @return Response
     */
    public function addTasks(Request $request)
    {
        $test = Test::find($request->test);
        if ($request->tasks != null) {
            $tasks = array_diff($request->tasks, $test->tasks()->pluck('id')->toArray());
            // spravit cez zachytenie vynimky (ked do DB davam rovnaky zaznam, ako tam uz je), aby som nemusela robit ten mnozinovy rozdiel
            $test->tasks()->attach($tasks);
        }

        return back();
    }

    /**
     * Remove elected tasks from a test.
     *
     * @param Request $request
     * @param Test $test
     * @return Response
     */
    public function removeTasks(Request $request, Test $test)
    {
        if ($request->selectedtasks != null) {
            $tasks = $request->selectedtasks;
            $test->tasks()->detach($tasks);
        }

        return back();
    }

}
