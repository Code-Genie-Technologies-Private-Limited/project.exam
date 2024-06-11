<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSchoolRequest;
use App\Http\Requests\UpdateSchoolRequest;
use App\Models\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schools = School::with('creator')
            ->orderBy('name', 'asc')
            ->paginate(10);

        return view('dashboard.schools.index', compact('schools'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.schools.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSchoolRequest $request)
    {
        School::create(array_merge(
            $request->validated(),
            ['created_by' => auth()->user()->id]
        ));
        $request->session()->flash('message', 'school created successfully.');
        return redirect()->route('schools.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(School $school)
    {
        return view('dashboard.schools.show',compact('school'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(School $school)
    {
        return view('dashboard.schools.edit',compact('school'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSchoolRequest $request, School $school)
    {
        $school->update($request->validated());
        $request->session()->flash('message', 'updated successfully.');
        return redirect()->route('schools.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(School $school, Request $request)
    {
        $school->delete();
        $request->session()->flash('message', 'deleted successfully');
        return redirect()->route('schools.index');
    }
}
