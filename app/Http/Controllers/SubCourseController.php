<?php

namespace App\Http\Controllers;

use App\Models\SubCourse;
use App\Http\Requests\StoreSubCourseRequest;
use App\Http\Requests\UpdateSubCourseRequest;
use App\Models\Course;
use Illuminate\Support\Facades\Validator;

class SubCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $subcourses = SubCourse::with('creator', 'subject')->orderBy('id', 'desc')->paginate(10);

        return view('dashboard.subcourse.index', compact('subcourses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Course::where('status', 1)->orderBy('order')->get();

        return view('dashboard.subcourse.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSubCourseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubCourseRequest $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:topics|min:3|max:200',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();
        SubCourse::create(array_merge($request->all(), ['created_by' => auth()->user()->id]));
        $request->session()->flash('message', 'Sub Course created successfully.');

        return redirect()->route('subcourse.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubCourse  $subCourse
     * @return \Illuminate\Http\Response
     */
    public function show(SubCourse $subCourse)
    {
        return view('dashboard.subcourse.show', compact('subCourse'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubCourse  $subCourse
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCourse $subCourse)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubCourse  $subCourse
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCourse $subCourse)
    {
        //
    }
}
