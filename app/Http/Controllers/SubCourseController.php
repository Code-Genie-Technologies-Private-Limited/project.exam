<?php

namespace App\Http\Controllers;

use App\Models\SubCourse;
use App\Http\Requests\StoreSubCourseRequest;
use App\Http\Requests\UpdateSubCourseRequest;

class SubCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
