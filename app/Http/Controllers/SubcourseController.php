<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubcourseRequest;
use App\Http\Requests\UpdateSubcourseRequest;
use App\Models\Subcourse;

class SubcourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcourse = Subcourse::with('creator')
            ->orderBy('order', 'DESC')
            ->pagination(10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.subcourses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSubcourseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubcourseRequest $request)
    {
        Subcourse::create(array_merge($request->all(), ['created_by' => auth()->user()->id]));

        return redirect()->route('subcourses.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subcourse  $subcourse
     * @return \Illuminate\Http\Response
     */
    public function show(Subcourse $subcourse)
    {
        return view('dashboard.subcourses.show', compact('subcourse'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subcourse  $subcourse
     * @return \Illuminate\Http\Response
     */
    public function edit(Subcourse $subcourse)
    {
        return view('dashboard.subcourses.show', compact('subcourse'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSubcourseRequest  $request
     * @param  \App\Models\Subcourse  $subcourse
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubcourseRequest $request, Subcourse $subcourse)
    {
        $subcourse->update($request->all());

        return redirect()->route('subcourses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subcourse  $subcourse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subcourse $subcourse)
    {
        $subcourse->delete();
        return redirect()->route('subcourses.index');
    }
}
