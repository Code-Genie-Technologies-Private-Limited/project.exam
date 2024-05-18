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
        $sub_courses = SubCourse::with(['user', 'course'])->orderBY('order', 'asc')->paginate(20);

        return view('dashboard.sub-courses.index', compact('sub_courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Course::where('status', 1)->get();
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
        $valiation = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:50|unique:sub_courses,name',
            'order' => 'nullable|min:1|max:8',
            'courese_id' => 'required|integet|exists:courses,id' . $request->courese_id
        ]);

        if ($valiation->fails()) {
            return redirect()->back()->withInput()->with('sub_coures_message', $valiation->errors());
        }

        $user = auth()->user();

        $sub_course = new SubCourse();
        $sub_course->name = $request->input('name');
        $sub_course->subject_id = $request->input('courese_id');
        $sub_course->order = $request->input('order');
        $sub_course->created_by = $user->id;
        $sub_course->save();

        return redirect()->route('sub-courses.index')->with('sub_coures_message', 'SubCourse created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubCourse  $subCourse
     * @return \Illuminate\Http\Response
     */
    public function show(SubCourse $subCourse)
    {
        $subCourse->with(['course', 'user'])->get();
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
        $subCourse->with('subject')->get();
        $courses = Course::query()->get();
        return view('dashboard.sub-courses.edit', compact(['subCourse', 'courses']));
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
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:50',
            'order' => 'nullable|min:1|max:8',
            'courese_id' => 'required|integet|exists:courses,id' . $request->courese_id
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withInput()->with('sub_coures_message', $validation->errors());
        }

        $subCourse->update($request->all());

        return redirect()->route('sub-courses.index')->with('sub_coures_message', 'SubCourse updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubCourse  $subCourse
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCourse $subCourse)
    {
        $subCourse->delete();
        return redirect()->route('sub-courses.index')->with('sub_coures_message', 'SubCourse deleted successfully.');
    }
}
