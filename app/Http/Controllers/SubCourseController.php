<?php

namespace App\Http\Controllers;

use App\Models\Sub_course;
use App\Http\Requests\StoreSub_courseRequest;
use App\Http\Requests\UpdateSub_courseRequest;

class SubCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sub_courses = Sub_course::with('course', 'creator')->paginate(10);
        return view('dashboard' . 'sub_courses' . 'index', compact('sub_courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSub_courseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSub_courseRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sub_course  $sub_course
     * @return \Illuminate\Http\Response
     */
    public function show(Sub_course $sub_course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sub_course  $sub_course
     * @return \Illuminate\Http\Response
     */
    public function edit(Sub_course $sub_course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSub_courseRequest  $request
     * @param  \App\Models\Sub_course  $sub_course
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSub_courseRequest $request, Sub_course $sub_course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sub_course  $sub_course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sub_course $sub_course)
    {
        //
    }
}
