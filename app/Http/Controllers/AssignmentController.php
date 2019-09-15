<?php

namespace App\Http\Controllers;

use App\Assignment;
use App\Test;
use App\Group;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAssignment;

class AssignmentController extends Controller
{
    /**
     * AssignmentController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Show the form for creating a new resource (assigning a test to a group).
     * @param Group $group
     * @return Response
     */
    public function create(Group $group = null)
    {
        $tests = Test::getTests()->get();
        if ($group == null) {
            $groups = Group::getGroups()->get();
        } else {
            $groups = null;
        }
        return view('assignment.create', [
            'tests' => $tests,
            'groups' => $groups,
            'group' => $group
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAssignment $request
     * @return Response
     */
    public function store(StoreAssignment $request)
    {
        $assg = Assignment::create([
            'test_id' => $request->test,
            'group_id' => $request->group,
            'mix_questions' => $request->mix_questions != null ? 1 : 0,
            'available_answers' => $request->available_answers != null ? 1 : 0,
            'available_from' => $request->available_from_date  . ' ' . $request->available_from_time . ':00',
            'available_to' => $request->available_to_date . ' ' . $request->available_to_time . ':00',
            'time_to_do' => $request->time_to_do
        ]);

        return back()->with([
            'success' => 'Test bol priradený skupine.'
        ]);
    }
}
