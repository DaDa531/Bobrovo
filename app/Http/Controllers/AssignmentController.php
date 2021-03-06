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
     * @param TestId
     * @param Group $group
     * @return Response
     */
    public function create($testId = 0, Group $group = null)
    {
        if ($group == null) {
            $groups = Group::getGroups()->get();
        } else {
            $groups = null;
        }

        if ($testId == 0){
            $tests = Test::getTests()->get();
            $test = null;
        } else {
            $tests = null;
            $test = Test::find($testId);
        }
        return view('assignment.create', [
            'tests' => $tests,
            'groups' => $groups,
            'group' => $group,
            'tests' => $tests,
            'test' => $test

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
            'mix_questions' => ($request->mix_questions) ? 1 : 0,
            'available_answers' => ($request->available_answers) ? 1 : 0,
            'available_from' => $request->available_from,
            'available_to' => $request->available_to,
            'time_to_do' => $request->time_to_do
        ]);

        return back()->with([
            'success' => 'Test bol priradený skupine.'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Assignment $assignment
     * @return Response
     */
    public function edit(Assignment $assignment)
    {
        $test = $assignment->test()->first();
        $group = $assignment->group()->first();

        if (!$group->authIsMyTeacher() || !$test->authIsMyAuthor())
            return back();


        return view('assignment.edit', [
            'assignment' => $assignment
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreAssignment $request
     * @param Assignment $assignment
     * @return Response
     */
    public function update(StoreAssignment $request, Assignment $assignment)
    {
        $assignment->update( [
            'test_id' => $request->test,
            'group_id' => $request->group,
            'available_from' => $request->available_from,
            'available_to' => $request->available_to,
            'time_to_do' => $request->time_to_do,
            'mix_questions' => $request->mix_questions != null ? 1 : 0,
            'available_answers' => $request->available_answers != null ? 1 : 0
        ]);

        return back()->with([
            'success' => 'Údaje boli úspešne zmenené!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Assignment $assignment
     * @return Response
     */
    public function destroy(Assignment $assignment)
    {
        $test = $assignment->test()->first();
        $group = $assignment->group()->first();

        if (!$group->authIsMyTeacher() || !$test->authIsMyAuthor())
            return back();

        $assignment->delete();

        return back()->with([
            'success' => 'Pridelenie testu skupine bolo zrušené!'
        ]);
    }
}
