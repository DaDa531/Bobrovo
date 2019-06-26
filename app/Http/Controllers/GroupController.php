<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Http\Request;

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
        $groups = Group::getGroupsFromCurrentTeacher()->get();
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
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
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
        return view('group.show', [
            'group' => $group,
            'students' => $group->students()->get(),
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

        //da sa zmazat, len ak v nej nie su ziadni studenti a nema priradene ziadne testy (ani stare)
        // ale mozno mozem zmazat ajs kupinu so studentami, studentov nebudemmzat, len z prepojovacky to treba zmazat

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
        $group->delete();

        return redirect()->route('group');/*->with([
            'success' => 'Skupina '.$group->name.' bola zrušená!'
        ]);*/
    }
}