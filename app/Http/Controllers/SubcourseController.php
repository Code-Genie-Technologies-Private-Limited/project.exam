<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubcourseRequest;
use App\Http\Requests\UpdateSubcourseRequest;
use App\Models\Course;
use App\Models\Subcourse;
use Illuminate\Http\Request;

class SubcourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subCourses = Subcourse::with('creator', 'course')
            ->orderBy('name', 'asc')
            ->orderBy('order', 'asc')
            ->paginate(10);

        return view('dashboard.sub-courses.index', compact('subCourses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $course = Course::where('status', 1)->get();

        return view('dashboard.sub-courses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubcourseRequest $request)
    {
        Subcourse::create(array_merge($request->validated(), ['created_by' => auth()->user()->id]));

        return redirect()->route('sub-courses.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subcourse $subcourse)
    {
        return view('dashboard.sub-courses.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subcourse $subcourse, Request $request)
    {
        $course = Course::where('status', 1)
            ->orWhere('id', $subcourse->course_id)->get();

        return view('dashboard.sub-courses.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubcourseRequest $request, Subcourse $subcourse)
    {
        $subcourse->update($request->validated());
        $request->session()->flash('message', 'Updated Successfully.');

        return redirect()->route('sub-courses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subcourse $subcourse, Request $request)
    {
        $subcourse->delete();
        $request->session()->flash('message', 'Deleted Successfully.');
        return redirect()->route('sub-courses.index');
    }
}
