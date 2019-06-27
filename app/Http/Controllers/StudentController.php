<?php

namespace App\Http\Controllers;

use App\Student;
use App\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
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
        $students = Student::getStudentsFromCurrentTeacher()->paginate(10);
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
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //generate code
        $code = '';
        $faker = Faker::create();
        while(true){
            $code = $faker->bothify('**********');
            $count = Student::getStudentsWithCode($code)->get()->count();
            if ($count == 0){
                break;
            }
        }

        //MA ZMYSEL ROBIT TO AKO TRANSAKCIU vytvorenie + zaradenie do skupin?
        $student = Student::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'code'=> $code,
            'teacher_id' => auth()->user()->id
        ]);

        if ($request->groups != null) {
            foreach ($request->groups as $group) {
                DB::table('student_group')->insert([
                    'student_id' => $student->id,
                    'group_id' => $group
                ]);
            }
        }

        return back()->with([
            'success' => 'Žiak '.$student->first_name.' '.$student->last_name . ' bol pridaný!'
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
                'success' => 'Žiak '.$student->first_name.' '.$student->last_name . ' bol zrušený!'
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

    /**
     * Store imported resources.
     *
     * @param Request $request
     * @return Response
     */
    public function multiStore(Request $request)
    {
        $this->validate($request, [
            'studentFile' => 'required'
        ]);

        $group_id = $request->input('group');

        $file = File::get($request->file('studentFile')->getRealPath());

        $count = 0;
        $tmp = 0;
        //DOPLNIT, ABY TO NEPADALO NA DUPLICATE ENTRY
        //KONTROLOVAT DLZKY JEDNOTLIVYCH POLOZIEK (MENO, PRIEZVISKO, KOD)
        // TRANSAKCIA?

        foreach (explode("\n", $file) as $line) {
            $data = explode(',', $line);

            if (count($data) != 3) continue;

            $student = Student::create([
                'first_name' => $data[0],
                'last_name' => $data[1],
                'code' => $data[2],
                'teacher_id' => auth()->user()->id
            ]);

            if ($group_id != '') {
                DB::table('student_group')->insert([
                    'student_id' => $student->id,
                    'group_id' => $group_id
                ]);
            }
            $count++;
        }
        $groups = Group::getGroupsFromCurrentTeacher()->get();

        return redirect()->route('student.import')->with([
            'success' => 'Úsprešne ste pridali ' . $count . ' žiakov!',
            'groups' => $groups
        ]);
    }
}
