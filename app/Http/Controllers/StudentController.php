<?php

namespace App\Http\Controllers;

use App\Student;
use App\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class StudentController extends Controller
{
    /**
     * StudentController constructor.
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
    $students = Student::getStudentsFromCurrentTeacher()->get();
    return view('student.index', [
        'students' => $students
    ]);
}

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $groups = Group::getGroupsFromCurrentTeacher()->get();
        return view('student.create', [
            'groups' => $groups
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //generate code
        $code = '';
        if ($request->input('generate-random-code') != null){
            $faker = Faker::create();
            while(true){
                $code = $faker->bothify('**********');

                $count = DB::table('students')->where([
                    ['code', $code]
                ])->count();

                if ($count == 0){
                    break;
                }
            }
        }
        else{
            $this->validate($request, [
                'code' => 'min:6|max:15|unique:students'
            ]);
            $code = $request->input('code');
        }

        $student = Student::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'code'=> $code,
            'teacher_id' => auth()->user()->id
        ]);

        //toto sa neda inak?
        if ($request->input('groups') != null) {
            foreach ($request->input('groups') as $group) {
                DB::table('student_group')->insert([
                    'student_id' => $student->id,
                    'group_id' => $group
                ]);
            }
        }

        return redirect()->route('student.create')->with([
            'success' => 'Študent '.$student->first_name.' '.$student->last_name . ' bol pridaný!'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Student $student
     * @return Response
     */
    public function show(Student $student)
    {
        $student_groups = $student->groups()->get();
        $available_groups = Group::getGroupsFromCurrentTeacher()->get()->diff($student_groups);

        return view('student.show', [
            'student' => $student,
            'groups' => $student_groups,
            'allgroups' => $available_groups
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Student $student
     * @return Response
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('student')->with([
                'success' => 'Študent '.$student->first_name.' '.$student->last_name . ' bol zrušený!'
            ]);
    }

    /**
     * Add student to a group.
     *
     * @param Request $request
     * @param Student $student
     * @return Response
     */
    public function addToGroup(Request $request, Student $student)
    {
        //toto sa neda inak?
        if ($request->input('addgroup') != null){
            DB::table('student_group')->insert([
                'student_id' => $student->id,
                'group_id' => $request->input('addgroup')
            ]);
        }
        return redirect()->route('student.show', $student->id);
    }


    /**
     * Remove student from a group.
     *
     * @param Request $request
     * @param StudentId
     * @param GroupId
     * @return Response
     */
    public function removeFromGroup(Request $request, $studentId, $groupId)
    {
        //toto sa neda inak?
        DB::table('student_group')->where([
            ['student_id', $studentId],
            ['group_id', $groupId],
        ])->delete();

        return redirect()->route('student.show', $studentId);
    }


    /**
     * Import students to a group.
     *
     * @param Request $request
     * @return Response
     */
    public function import(Request $request)
    {
        $groups = Group::getGroupsFromCurrentTeacher()->get();
        return view('student.import', [
            'groups' => $groups
        ]);
    }
}
