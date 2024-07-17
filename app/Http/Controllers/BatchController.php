<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Http\Requests\StoreBatchRequest;
use App\Http\Requests\UpdateBatchRequest;
use App\Models\Course;
use App\Models\SubCourse;
use App\Models\User;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);

        $batches = Batch::with(['creator', 'course', 'subCourse'])
            ->filter($request->all())
            ->orderBy('order', 'desc')
            ->paginate($perPage)
            ->appends($request->query());

        $courses = Course::where('status', 1)
            ->orderBy('order', 'desc')
            ->get();

        $subCourses = SubCourse::where('status', 1)
            ->orderBy('order', 'desc')
            ->get();

        $creators = User::all();

        return view('dashboard.batches.index', [
            'batches' => $batches,
            'courses' => $courses,
            'subCourses' => $subCourses,
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
            ->orderBy('order', 'desc')
            ->get();

        $subCourses = SubCourse::where('status', 1)
            ->orderBy('order', 'desc')
            ->get();

        return view('dashboard.batches.create', [
            'courses' => $courses,
            'subCourses' => $subCourses,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBatchRequest $request)
    {
        Batch::create(array_merge($request->validated(), ['created_by' => auth()->user()->id]));

        return redirect()->route('batches.index', $request->query())
            ->with('message', 'Batch has been stored successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Batch $batch, Request $request)
    {
        $courses = Course::where('status', 1)
            ->orderBy('order', 'desc')
            ->get();

        $subCourses = SubCourse::where('status', 1)
            ->orderBy('order', 'desc')
            ->get();

        $creators = User::all();

        return view('dashboard.batches.show', [
            'batch' => $batch,
            'courses' => $courses,
            'subCourses' => $subCourses,
            'creators' => $creators,
            'filters' => $request->all(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Batch $batch, Request $request)
    {
        $courses = Course::where('status', 1)
            ->orderBy('order', 'desc')
            ->get();

        $subCourses = SubCourse::where('status', 1)
            ->orderBy('order', 'desc')
            ->get();

        $creators = User::all();

        return view('dashboard.batches.edit', [
            'batch' => $batch,
            'courses' => $courses,
            'subCourses' => $subCourses,
            'creators' => $creators,
            'filters' => $request->all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBatchRequest $request, Batch $batch)
    {
        $batch->update($request->validated());

        return redirect('batches.index', $request->query())
            ->with('message', 'Batch has been updated successfulluy.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Batch $batch, Request $request)
    {
        $filters = $request->input('_token', '_method');

        $batch->delete();

        return redirect()->route('batches.index', $filters)
            ->with('message', 'Batch has been deleted successfulluy.');
    }
}
