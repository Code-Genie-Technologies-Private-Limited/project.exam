<?php

namespace App\Http\Controllers;

use App\Models\SubCourse;
use App\Http\Requests\StoreSubCourseRequest;
use App\Http\Requests\UpdateSubCourseRequest;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class SubCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);

        $subCourses = SubCourse::with(['creator', 'course'])
            ->orderBy('order', 'desc')
            ->filter($request->all())
            ->paginate($perPage)
            ->appends($request->query());

        $courses = Course::orderBy('order')->get();
        // dd($courses);
        $creators = User::all();


        return view('dashboard.sub_courses.index', [
            'subCourses' => $subCourses,
            'courses' => $courses,
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

        return view('dashboard.sub_courses.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubCourseRequest $request)
    {

        SubCourse::create(array_merge($request->validated(), ['created_by' => auth()->user()->id]));

        return redirect()->route('sub-courses.index', $request->query())
            ->with('message', 'Sub Course has been added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SubCourse $subCourse, Request $request)
    {
        $courses = Course::where('status', 1)
            ->orderBy('order')->get();

        return view('dashboard.sub_courses.show', [
            'subCourse' => $subCourse,
            'courses' => $courses,
            'filters' => $request->query(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCourse $subCourse, Request $request)
    {
        $courses = Course::where('status', 1)
            ->orWhere('id', $subCourse->course_id)
            ->orderBy('order')
            ->get();

        return view('dashboard.sub_courses.edit', [
            'subCourse' => $subCourse,
            'courses' => $courses,
            'filters' => $request->query()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubCourseRequest $request, SubCourse $subCourse)
    {
        $subCourse->update($request->validated());

        return redirect()->route('sub-courses.index', $request->query())
            ->with('message', 'Sub Course has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCourse $subCourse, Request $request)
    {
        $filters = $request->except('_token', '_method');

        // if ($topic->questions()->exists()) {
        //     return redirect()->route('topics.index', ['page' => $request->input('page', 1)])
        //         ->with('error', 'Cannot delete this topic as it has one or more associated questions.');
        // }

        $subCourse->delete();

        return redirect()->route('sub-courses.index', $request->query())
            ->with('message', 'Sub Course has been deleted successfully.');
    }
}
