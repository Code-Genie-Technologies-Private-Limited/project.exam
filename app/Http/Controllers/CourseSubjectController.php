<?php

namespace App\Http\Controllers;

use App\Models\CourseSubject;
use App\Http\Requests\StoreCourseSubjectRequest;
use App\Http\Requests\UpdateCourseSubjectRequest;
use App\Models\Course;
use App\Models\Subject;
use Illuminate\Http\Request;

class CourseSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courseSubjects = CourseSubject::with('creator', 'subject')
        ->orderBy('id', 'desc')
        ->paginate(10);

        // Fetch all subjects

        return view('dashboard.courseSubject.index', compact('courseSubjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subjects = Subject::all();
        $courses = Course::all();
        return view('dashboard.courseSubject.create',compact('subjects', 'courses'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseSubjectRequest $request)
    {
        CourseSubject::create(array_merge($request->validated(), ['created_by' => auth()->user()->id]));
        $request->session()->flash('message', 'CourseSubject created successfully.');

        return redirect()->route('CourseSubject.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(CourseSubject $courseSubject)
    {
        return view('dashboard.CourseSubject.show', compact('courseSubject'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourseSubject $courseSubject)
    {
        return view('dashboard.courseSubject.edit', compact('courseSubject'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseSubjectRequest $request, CourseSubject $courseSubject)
    {
        $courseSubject->update($request->validated());

        $request->session()->flash('message', "courseSubject updated successfully.");

        return redirect()->route('courseSubject.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseSubject $courseSubject, Request $request)
    {
        $courseSubject->delete();

        $request->session()->flash('message', 'courseSubject deleted successfully.');

        return redirect()->route('courseSubject.index');
    }
}
