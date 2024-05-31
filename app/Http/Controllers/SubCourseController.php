<?php

namespace App\Http\Controllers;

use App\Models\SubCourse;
use App\Http\Requests\StoreSubCourseRequest;
use App\Http\Requests\UpdateSubCourseRequest;
use App\Models\Course;
use Illuminate\Http\Request;

class SubCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subCourses = SubCourse::with('creator', 'course')
            ->orderBy('order', 'asc')
            ->orderBy('name')
            ->paginate(10);

        return view('dashboard.sub-courses.index', compact('subCourses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Course::where('status', 1)
            ->orderBy('order', 'desc')
            ->orderBy('name')
            ->get();

        return view('dashboard.sub-courses.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSubCourseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubCourseRequest $request)
    {
        SubCourse::create(array_merge(
            $request->validated(),
            ['created_by' => auth()->user()->id]
        ));

        $request->session()->flash('message', 'Sub course has been added successfully.');

        return redirect()->route('sub-courses.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubCourse  $subCourse
     * @return \Illuminate\Http\Response
     */
    public function show(SubCourse $subCourse)
    {
        return view('dashboard.sub-courses.show', compact('subCourse'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubCourse  $subCourse
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCourse $subCourse)
    {
        $courses = Course::where('status', 1)
            ->orWhere('id', $subCourse->course_id)
            ->orderBy('order', 'desc')
            ->orderBy('name')
            ->get();

        return view('dashboard.sub-courses.edit', compact('subCourse', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSubCourseRequest  $request
     * @param  \App\Models\SubCourse  $subCourse
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubCourseRequest $request, SubCourse $subCourse)
    {
        $subCourse->update($request->validated());
        $request->session()->flash('message', 'Sub course has been updated successfully.');

        return redirect()->route('sub-courses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubCourse  $subCourse
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCourse $subCourse, Request $request)
    {
        $subCourse->delete();
        $request->session()->flash('message', 'Sub course has been deleted successfully.');

        return redirect()->route('sub-courses.index');
    }
}
