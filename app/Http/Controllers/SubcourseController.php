<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubcourseRequest;
use App\Http\Requests\UpdateSubcourseRequest;
use App\Models\Course;
use App\Models\Subcourse;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class SubcourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcourses = Subcourse::with('creator', 'course')
            ->orderBy('order', 'DESC')
            ->pagination(10);
        return view('Dashboard.sub-cources.index', compact('subcourses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $course = Course::where('satus', 1)
            ->orderBy('order')
            ->orderBy('name')
            ->get();

        return view('dashboard.sub-cources.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSubcourseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubcourseRequest $request)
    {
        Subcourse::create(array_merge(
            $request->all(),
            ['created_by' => auth()->user()->id]
        ));
        $request->session()->flash('message', 'Sub-cources is created successfully.');


        return redirect()->route('sub-cources.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subcourse  $subcourse
     * @return \Illuminate\Http\Response
     */
    public function show(Subcourse $subcourse)
    {
        return view('dashboard.sub-cources.show', compact('subcourse'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subcourse  $subcourse
     * @return \Illuminate\Http\Response
     */
    public function edit(Subcourse $subcourse)
    {
        $subcourse = Course::where('satus', 1)
            ->orderBy('order')
            ->orderBy('name')
            ->get();

        return view('dashboard.sub-cources.show', compact('subcourse'));
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

        $request->session()->flash('message', 'Sub-cources is updated successfully.');

        return redirect()->route('sub-cources.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subcourse  $subcourse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subcourse $subcourse, Request $request)
    {
        $subcourse->delete();
        $request->session()->flash('message', 'Sub-cources is deleted successfully.');
        return redirect()->route('sub-cources.index');
    }
}
