<?php

namespace App\Http\Controllers;

use App\Models\SubCourse;
use App\Http\Requests\StoreSubCourseRequest;
use App\Http\Requests\UpdateSubCourseRequest;
use App\Models\Course;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class SubCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $perPage = $request->input('per_page', 10);

        $subcourses = SubCourse::with('course', 'creator')
            ->orderBy('order', 'desc')
            ->filter($request->all())
            ->paginate($perPage);

        $courses = Course::orderBy('order')->get();

        $creators = User::all();
        // dd($courses->toarray());
        return view('dashboard.subcourses.index', [
            'subcourses' => $subcourses,
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
        $courses = Course::where('status', 1)->orderBy('order')->get();
        return view('dashboard.subcourses.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubCourseRequest $request)
    {
        SubCourse::create(array_merge($request->validated(), ['created_by' => auth()->user()->id]));

        return redirect()->route('subcourses.index', $request->query())
            ->with('message', 'The SubCourses has been created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SubCourse $subCourse, Request $request)
    {
        $courses = Course::where('status', 1)->orderBy('order')->get();

        return view('dashboard.subcourses.show', [
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

        $course = Course::where('status', 1)
            ->orWhere('id', $subCourse->course_id)
            ->orderBy('order')
            ->get();

        return view('dashboard.subcourses.edit', [
            'subCourse' => $subCourse,
            'courses' => $course,
            'filters' => $request->query(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubCourseRequest $request, SubCourse $subCourse)
    {
        $subCourse->update($request->validated());

        return redirect()->route('subcourses.index', $request->query())
            ->with('message', 'The SubCourses has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCourse $subCourse, Request $request)
    {

        $filters = $request->except('_token', '_method');

        $subCourse->delete();

        return redirect()->route('subcourses.index', $filters)
            ->with('message', "The subCourse has been deleted successfully.");
    }
}
