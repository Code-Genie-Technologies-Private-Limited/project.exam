<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::with('creator')
            ->orderBy('name', 'asc')
            ->orderBy('order', 'asc')
            ->paginate(10);

        return view('dashboard.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.courses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseRequest $request)
    {
        Course::create(array_merge($request->validated(), ['created_by' => auth()->user()->id]));

        $request->session()->flash('message', 'Course has been added successfully.');

        return redirect()->route('courses.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        return view('dashboard.courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        return view('dashboard.courses.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        $course->update($request->validated());

        $request->session()->flash('message', 'Updated successfully.');
        return redirect()->route('courses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course, Request $request)
    {
        if ($course->has('subcourse')->exists()) {
            $request->session()->flash('error', 'course has many subcourses');
            return redirect()->route('courses.index');
        }
        $course->delete();
        $request->session()->flash('message', 'deleted successfully.');

        return redirect()->route('courses.index');
    }
}
