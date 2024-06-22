<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $perPage = $request->input('per_page', 10);

        $courses = Course::filter($request->all())
            ->with('creator')
            // ->withCount('topics')
            ->orderBy('order')
            ->paginate($perPage)
            ->appends($request->query());

        $creators = User::all();

        return view('dashboard.courses.index', [
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
        return view('dashboard.courses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseRequest $request): RedirectResponse
    {
        Course::create(array_merge($request->validated(), ['created_by' => auth()->user()->id]));

        return redirect()->route('courses.index', $request->query())
            ->with('message', 'The Course has been created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course, Request $request): View
    {
        return view('dashboard.courses.show', [
            'course' => $course,
            'filters' => $request->query(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course, Request $request): View
    {
        return view('dashboard.courses.edit', [
            'course' => $course,
            'filters' => $request->query(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, Course $course): RedirectResponse
    {
        $course->update($request->validated());

        return redirect()->route('courses.index', $request->query())
            ->with('message', 'The course has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course, Request $request): RedirectResponse
    {
        $filters = $request->except('_token', '_method');

        $course->delete();

        return redirect()->route('courses.index', $filters)
            ->with('message', 'The course has been deleted successfully.');
    }
}
