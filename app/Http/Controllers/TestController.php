<?php

namespace App\Http\Controllers;

use App\Test;
use Illuminate\Http\Request;

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
        $tests = Test::paginate(10);
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
        ]);
    }
}
