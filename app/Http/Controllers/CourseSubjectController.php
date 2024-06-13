<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseSubjectRequest;
use App\Http\Requests\UpdateCourseSubjectRequest;
use App\Models\Course;
use App\Models\CourseSubject;
use App\Models\Subject;
use Illuminate\Http\Request;

class CourseSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courseSubjects = CourseSubject::with('creator', 'course', 'subject')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('dashboard.course-subjects.index', compact('courseSubjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::where('status', 1)->get();
        $subjects = Subject::where('status', 1)->get();

        return view('dashboard.course-subjects.create', compact('courses', 'subjects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseSubjectRequest $request)
    {
        CourseSubject::create(array_merge(
            $request->validated(),
            ['created_by' => auth()->user()->id]
        ));

        $request->session()->flash('message', 'created successfully.');

        return redirect()->route('course-subjects.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(CourseSubject $courseSubject)
    {
        return view('dashboard.course-subjects.show', compact('courseSubject'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourseSubject $courseSubject)
    {
        $courses = Course::where('status', 1)
            ->orWhere('id', $courseSubject->course_id)->get();

        $subjects  = Subject::where('status', 1)
            ->orWhere('id', $courseSubject->subject_id)->get();


        return view('dashboard.course-subjects.edit', compact('courseSubject', 'courses', 'subjects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseSubjectRequest $request, CourseSubject $courseSubject)
    {
        $courseSubject->update($request->validated());

        $request->session()->flash('message', 'updated successfully.');

        return redirect()->route('course-subjects.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseSubject $courseSubject, Request $request)
    {
        $courseSubject->delete();

        $request->session()->flash('message', 'deleted successfully.');

        return redirect()->route('course-subjects.index');
    }
}
