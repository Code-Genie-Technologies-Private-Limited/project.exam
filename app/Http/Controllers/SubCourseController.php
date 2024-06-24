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

        $suCourses = SubCourse::with(['creator', 'course'])
            ->orderBy('order', 'desc')
            ->filter($request->all())
            ->paginate($perPage);

        $courses = Course::orderBy('order')->get();

        $creators = User::all();

        return view('dashboard.sub-courses.index', []);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubCourseRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SubCourse $subCourse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCourse $subCourse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubCourseRequest $request, SubCourse $subCourse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCourse $subCourse)
    {
        //
    }
}
