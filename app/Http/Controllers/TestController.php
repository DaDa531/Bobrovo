<?php

namespace App\Http\Controllers;

use App\Test;
use App\Group;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTest;
use Illuminate\Http\Response;

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
        return view('test.show', [
            'test' => $test
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

        return back();

        $test = Test::create([
            'name' => $request->title,
            'description' => $request->question,
            'teacher_id' => auth()->user()->id
        ]);


        return redirect()->route('test.create')->with([
            'success' => 'Test '. $test->name . ' bol vytvorený!'
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
     * Show the form for assigning a test to a group.
     *
     * @return Response
     */
    public function assign()
    {
        $tests = Test::getTests()->get();
        $groups = Group::getGroups()->get();
        return view('test.assign', [
            'tests' => $tests,
            'groups' => $groups
        ]);
    }
}
