<?php

namespace App\Http\Controllers;

use App\Models\SubCourse;
use App\Http\Requests\StoreSubCourseRequest;
use App\Http\Requests\UpdateSubCourseRequest;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subCourses = SubCourse::with(['course', 'creator'])->paginate(10);
        return view('dashboard.sub-courses.index', compact('subCourses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::where('status', 1)->orderBy('order')->get();
        return view('dashboard.sub-courses.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubCourseRequest $request)
    {
        $validation = Validator::make($request->all(), [
            'course_id' => 'required|integer|exists:courses,id',
            'name' => 'required|min:3|max:160',
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withInput()->withErrors($validation);
        }

        SubCourse::create(array_merge($request->all(), ['created_by' => auth()->user()->id]));

        $request->session()->flash('message', 'SubCourse created successfully.');
        return redirect()->route('sub-courses.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(SubCourse $subCourse)
    {
        return view('dashboard.sub-courses.show', compact('subCourse'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCourse $subCourse)
    {
        $courses = Course::where('status', 1)->orderBy('order')->get();
        return view('dashboard.sub-courses.edit', compact(['subCourse', 'courses']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubCourseRequest $request, SubCourse $subCourse)
    {
        $validation = Validator::make($request->all(), [
            'course_id' => 'required|exists:courses,id',
            'name' => 'required|min:3|max:160'
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withInput()->withErrors($validation);
        }

        $subCourse->update($request->all());

        $request->session()->flash('SubCourse updated successfully.');
        return redirect()->route('sub-courses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCourse $subCourse, Request $request)
    {
        $subCourse->delete();

        $request->session()->flash('message', 'Course deletd successfully.');
        return redirect()->route('sub-courses.index');
    }
}
