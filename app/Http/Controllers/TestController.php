<?php

namespace App\Http\Controllers;

use App\Test;
use App\Group;
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
        return view('test.show', [
            'test' => $test,
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
        $test = Test::create([
            'name' => $request->name,
            'description' => $request->description,
            'teacher_id' => auth()->user()->id,
            'available_description' => $request->available_description != null ? 1 : 0,
            'public' => 0
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

}
