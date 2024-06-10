<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Models\School;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::with('creator', 'school')
            ->orderBy('order', 'asc')
            ->orderBy('name', 'asc')
            ->paginate(10);

        return view('dashboard.teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $schools = School::where('status', 1)->get();

        return view('dashboard.teachers.create', compact('schools'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeacherRequest $request)
    {
        Teacher::create(array_merge($request->validated(), ['created_by' => auth()->user()->id]));
        $request->session()->flash('message', 'Teacher has been added successfully.');

        return redirect()->route('teachers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        return view('dashboard.teachers.show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        $schools = School::where('status', 1)
            ->orWhere('id', $teacher->school_id)
            ->get();

        return view('dashboard.teachers.edit', compact('teacher', 'schools'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTeacherRequest $request, Teacher $teacher)
    {
        $teacher->update($request->validated());
        $request->session()->flash('message', 'Teacher has been updated successfully.');

        return redirect()->route('teachers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher, Request $request)
    {
        $teacher->delete();
        $request->session()->flash('message', 'Teacher has been deleted successfully.');

        return redirect()->route('teachers.index');
    }
}
