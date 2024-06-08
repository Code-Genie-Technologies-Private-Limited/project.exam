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
     */
    public function index()
    {
        $subCourses = SubCourse::with('creator', 'course')
            ->orderBy('order', 'asc')
            ->orderBy('name', 'asc')
            ->paginate(10);

        return view('dashboard.subcourses.index', compact('subCourses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::where('status', 1)->get();

        return view('dashboard.subcourses.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubCourseRequest $request)
    {
        SubCourse::create(array_merge($request->validated(), ['created_by' => auth()->user()->id]));
        $request->session()->flash('message', 'Subcourse has been added successfully.');

        return redirect()->route('sub-courses.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(SubCourse $subCourse)
    {
        return view('dashboard.subcourses.show', compact('subCourse'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCourse $subCourse)
    {
        $courses = Course::where('status', 1)
            ->orWhere('id', $subCourse->course_id)
            ->get();

        return view('dashboard.subcourses.edit', compact('subCourse', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubCourseRequest $request, SubCourse $subCourse)
    {
        $subCourse->update($request->validated());
        $request->session()->flash('message', 'Subcourse has been updated successfully.');

        return redirect()->route('sub-courses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCourse $subCourse, Request $request)
    {
        $subCourse->delete();
        $request->session()->flash('message', 'Subcourse has been deleted successfully.');

        return redirect()->route('sub-courses.index');
    }
}
