<?php

namespace App\Http\Controllers;

use App\Models\CourseSubject;
use App\Http\Requests\StoreCourseSubjectRequest;
use App\Http\Requests\UpdateCourseSubjectRequest;
use App\Models\Course;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;

class CourseSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);

        $courseSubjects = CourseSubject::with('creator', 'course', 'subject')
            ->filter($request->all())
            ->orderBy('id', 'desc')
            ->paginate($perPage)
            ->appends($request->query());

        $courses = Course::where('status', 1)->get();

        $subjects = Subject::where('status', 1)->get();

        $creators = User::all();

        return view('dashboard.course_subjects.index', [
            'courseSubjects' => $courseSubjects,
            'courses' => $courses,
            'subjects' => $subjects,
            'creators' => $creators,
            'filters' => $request->all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::where('status', 1)
            ->orderBy('order')
            ->get();

        $subjects = Subject::where('status', 1)
            ->orderBy('order')
            ->get();

        return view('dashboard.course_subjects.create', [
            'courses' => $courses,
            'subjects' => $subjects,
        ]);
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

        return redirect()->route('course-subjects.index', $request->query())
            ->with('message', 'Course Subject has been added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CourseSubject $courseSubject, Request $request)
    {
        $courses = Course::where('status', 1)
            ->orderBy('order')
            ->get();

        $subjects = Subject::where('status', 1)
            ->orderBy('order')
            ->get();

        return view('dashboard.course_subjects.edit', [
            'courseSubject' => $courseSubject,
            'courses' => $courses,
            'subjects' => $subjects,
            'filters' => $request->query(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourseSubject $courseSubject, Request $request)
    {
        $courses = Course::where('status', 1)
            ->orderBy('order')
            ->get();

        $subjects = Subject::where('status', 1)
            ->orderBy('order')
            ->get();

        return view('dashboard.course_subjects.edit', [
            'courseSubject' => $courseSubject,
            'courses' => $courses,
            'subjects' => $subjects,
            'filters' => $request->query()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseSubjectRequest $request, CourseSubject $courseSubject)
    {
        $courseSubject->update($request->validated());

        return redirect()->route('course-subjects.index', $request->query())
            ->with('message', 'Course Subject has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseSubject $courseSubject, Request $request)
    {
        $filters = $request->except('_token', '_method');

        $courseSubject->delete();

        return redirect()->route('course-subjects.index', $filters)
            ->with('message', 'Course Subject has been deleted successfully.');
    }
}
