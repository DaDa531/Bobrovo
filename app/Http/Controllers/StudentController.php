<?php

namespace App\Http\Controllers;

use App\Student;
use App\Group;
use App\Http\Requests\StoreStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Faker\Factory as Faker;
use Illuminate\Http\Response;

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

        $students = Student::getStudents()->paginate(10);
        $groups = Group::getGroups()->get();
        return view('student.index', [
            'students' => $students,
            'groups' => $groups
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $groups = auth()->user()->groups()->get();
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
        if (!$student->authIsMyTeacher())
            return back();

        return view('student.show', [
            'student' => $student,
            'groups' => $student->groups()->orderBy('name')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreStudent $request
     * @return Response
     */
    public function store(StoreStudent $request)
    {
        //SPRAVIT AKO TRANSAKCIU vytvorenie + zaradenie do skupin?
        $code = Student::generateCode();

        $student = Student::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'code'=> $code,
            'teacher_id' => auth()->user()->id
        ]);


        if ($request->groups != null) {
            $student->groups()->attach($request->groups);
        }

        return back()->with([
            'success' => 'Žiak '.$student->first_name.' '.$student->last_name . ' bol pridaný!'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Student $student
     * @return Response
     */
    public function edit(Student $student)
    {
        if (!$student->authIsMyTeacher())
            return back();

        $assigned_groups = $student->groups()->get();
        $available_groups = auth()->user()->groups()->get()->diff($assigned_groups);

        return view('student.edit', [
            'student' => $student,
            'assigned_groups' => $assigned_groups,
            'available_groups' => $available_groups
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param StoreStudent $request
     * @param Student $student
     * @return Response
     */
    public function update(StoreStudent $request, Student $student)
    {
        //MA ZMYSEL ROBIT TO AKO TRANSAKCIU vytvorenie + zaradenie do skupin?

        $student->update($request->only('first_name', 'last_name'));

        $assigned_groups = $student->groups()->get();

        return redirect()->route('student.show', $student->id)->with([
            'groups' => $assigned_groups,
            'success' => 'Údaje o žiakovi boli úspešne zmenené!'
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
        if (!$student->authIsMyTeacher())
            return back();

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
        if ($request->groups != null) {
            $student->groups()->attach($request->groups);
        }

        $assigned_groups = $student->groups()->get();
        $available_groups = auth()->user()->groups()->get()->diff($assigned_groups);

        return view('student.edit', [
            'student' => $student,
            'assigned_groups' => $assigned_groups,
            'available_groups' => $available_groups
        ]);
    }

    /**
     * Remove student from a group.
     *
     * @param Request $request
     * @param Student $student
     * @param $groupId
     * @return Response
     */
    public function removeFromGroup(Request $request, Student $student, $groupId)
    {
        $student->groups()->detach($groupId);

        $assigned_groups = $student->groups()->get();
        $available_groups = auth()->user()->groups()->get()->diff($assigned_groups);

        return view('student.edit', [
            'student' => $student,
            'assigned_groups' => $assigned_groups,
            'available_groups' => $available_groups
        ]);
    }


    /**
     * Import students to a group.
     *
     * @param Request $request
     * @return Response
     */
    public function import(Request $request)
    {
        $groups = auth()->user()->groups()->get();
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
                $student->groups()->attach($group_id);
            }
            $count++;
        }
        $groups = auth()->user()->groups()->get();

        return redirect()->route('student.import')->with([
            'success' => 'Počet úspešne pridaných žiakov: ' . $count,
            'groups' => $groups
        ]);
    }

    //PDF - https://github.com/niklasravnsborg/laravel-pdf


    /**
     * Add selected students to selected group.
     *
     * @param Request $request
     * @return Response
     */
    public function multiAddToGroup(Request $request)
    {
        if ($request->pupils != null and $request->group != null) {
            $group = Group::find($request->group);
            $students = array_diff($request->pupils, $group->students()->pluck('id')->toArray());
            $group->students()->attach($students);
        }

        return back();
    }
}
