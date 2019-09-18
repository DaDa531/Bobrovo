<?php

namespace App\Http\Controllers;

use App\Group;
use App\Student;
use Illuminate\Http\Request;
use App\Http\Requests\StoreGroup;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;

class GroupController extends Controller
{
    /**
     * GroupController constructor.
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
        $groups = Group::getGroups()->orderBy('name')->get();
        return view('group.index', [
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
        return view('group.create', []);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param StoreGroup $request
     * @return Response
     */
    public function store(StoreGroup $request)
    {
        $group = Group::create([
            'name' => $request->name,
            'description'=> ($request->description == null ? '' : $request->description),
            'created_by' => auth()->user()->id
        ]);

        //return redirect()->route('group.show', $group->id);
        return redirect()->route('group.create')->with([
            'success' => 'Skupina '. $group->name . ' bola vytvorená!'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Group $group
     * @return Response
     */
    public function show(Group $group)
    {
        if (!$group->authIsMyTeacher())
            return back();

        return view('group.show', [
            'group' => $group,
            'students' => $group->students()->orderBy('last_name')->get(),
            'test_assignments' => collect($group->assignments()->get()->load(['test'])),
            'time' => Carbon::now('Europe/Paris')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Group $group
     * @return Response
     */
    public function edit(Group $group)
    {

        if (!$group->authIsMyTeacher())
            return back();

        $students = $group->students();
        return view('group.edit', [
            'group' => $group,
            'students' => $students->get(),
            'allstudents' => Student::getStudentsExcept( $students->pluck('id')->toArray())->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreGroup $request
     * @param Group $group
     * @return Response
     */
    public function update(StoreGroup $request, Group $group)
    {
        if ($request->description == null)
            $group->update($request->only('name'));
        else
            $group->update($request->only('name', 'description'));

        $students = $group->students()->get();

        return redirect()->route('group.show', $group->id)->with([
            'students' => $students,
            'success' => 'Údaje o skupine boli úspešne zmenené!'
        ]);
    }

    /**
     * Remove student from a group.
     *
     * @param Request $request
     * @param Group $group
     * @param Student $student
     * @return Response
     */
    public function removeStudent(Request $request, Group $group, Student $student)
    {
        $student->groups()->detach($group->id);

        return view('group.edit', [
            'group' => $group,
            'students' => $group->students()->get(),
            'allstudents' => Student::getStudents()->get()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Group $group
     * @return Response
     */
    public function destroy(Group $group)
    {
        if (!$group->authIsMyTeacher())
            return back();

        //da sa zmazat, len ak v nej nie su ziadni studenti a nema priradene ziadne testy (ani stare)
        // ale mozno mozem zmazat aj skupinu so studentami, studentov nebudem mazat, len z prepojovacky to treba zmazat

        /*try {
            DB::transaction(function () use ($group) {

                if (!$group->canDelete()) {
                    throw new Exception('Skupina sa nedá zmazať, lebo obsahuje študentov.');
                }

                $deleted = $group->delete();

                if (count($group->students) != 0) {
                    throw new Exception('Something wrong !');
                }
            });
        } catch (Exception $exception) {
            return back()->withErrors($exception->getMessage());
        }*/
        $groupname = $group->name;
        $group->delete();
        $groups = Group::getGroups()->orderBy('name')->get();

        return redirect()->route('group')->with([
            'groups' => $groups,
            'success' => 'Skupina '. $groupname. ' bola zrušená!'
        ]);
    }

    /**
     * Add selected students to a group.
     *
     * @param Request $request
     * @param Group $group
     * @return Response
     */
    public function addStudents(Request $request, Group $group)
    {
        if ($request->pupils != null) {
            $students = array_diff($request->pupils, $group->students()->pluck('id')->toArray());
            $group->students()->attach($students);
        }

        return back();
    }

    /**
     * Remove student from a group.
     *
     * @param Request $request
     * @param Group $group
     * @return Response
     */
    public function removeStudents(Request $request, Group $group)
    {
        if ($request->pupils != null) {
            $students = $request->pupils;
            $group->students()->detach($students);
        }

        return back();
    }
}