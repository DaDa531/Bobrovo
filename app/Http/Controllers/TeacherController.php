<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
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

        return view('teacher.index', [
            'currentUser' => Auth::user()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @return Response
     */
    public function show()
    {

    }

}
