<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::with('user')->orderBy('order', 'asc')->paginate(20);
        return view('dashboard.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.courses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCourseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCourseRequest $request)
    {
        $valiation = Validator::make($request->all(), [
            'name' => 'required|string|min:1|max:50|unique:courses,name',
            'order' => 'nullable|min:1|max:8',
        ]);

        if ($valiation->fails()) {
            return redirect()->back()->withInput()->with('course_message', $valiation->errors());
        }

        $user = auth()->user();
        $course = new Course();
        $course->name = $request->input('name');
        $course->order = $request->input('order');
        $course->created_by = $user->id;
        $course->save();

        return redirect()->route('courses.index')->with('course_message', 'Course created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        $course->with('user')->get();
        return view('dashboard.courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        return view('dashboard.courses.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCourseRequest  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        $valiation = Validator::make($request->all(), [
            'name' => 'required|string|min:1|max:50',
            'order' => 'nullable|min:1|max:8'
        ]);

        if ($valiation->fails()) {
            return redirect()->back()->withInput()->with('course_message', $valiation->errors());
        }

        $course->update($request->all());

        return redirect()->route('courses.index')->with('course_message', 'Course updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index')->with('course_message', 'Course deletd successfully.');
    }
}
