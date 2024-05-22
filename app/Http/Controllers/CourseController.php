<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::with('creator')->orderBy('order')->paginate(10);
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
        $validation = Validator::make($request->all(), [
            'name' => 'required|min:1|max:160|unique:courses,name'
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withInput()->withErrors($validation);
        }

        Course::create(array_merge($request->all(), ['created_by' => auth()->user()->id]));

        $request->session()->flash('message', 'Course created successfully.');
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
        $validation = Validator::make($request->all(), [
            'name' => 'required|min:1|max:160',
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withInput()->withErrors($validation);
        }

        $course->update($request->all());

        $request->session()->flash('message', 'Course updated successfully.');
        return redirect()->route('courses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course, Request $request)
    {
        $hasSubCourse = $course->sub_course()->exists();

        if ($hasSubCourse) {
            $request->session()->flash('message', "Can't delete. Course has assigned one or more sub courses.");
            return redirect()->route('courses.index');
        }

        $course->delete();
        $request->session()->flash('message', 'Course deletd successfully.');
        return redirect()->route('courses.index');
    }
}
