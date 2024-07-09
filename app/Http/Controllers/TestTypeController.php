<?php

namespace App\Http\Controllers;

use App\Models\TestType;
use App\Http\Requests\StoreTestTypeRequest;
use App\Http\Requests\UpdateTestTypeRequest;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class TestTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);

        $testTypes = TestType::filter($request->all())
            ->with('creator', 'course')
            ->orderBy('order')
            ->paginate($perPage)
            ->appends($request->query());

        $courses = Course::where('status', 1)
            ->orderBy('order')
            ->get();

        $creators = User::all();

        return view('dashboard.test_types.index', [
            'testTypes' => $testTypes,
            'courses' => $courses,
            'creators' => $creators,
            'filters' => $request->query(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::where('status', 1)
            ->orderBy('order')
            ->get();

        return view('dashboard.test_types.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTestTypeRequest $request)
    {
        TestType::create(array_merge($request->validated(), ['created_by' => auth()->user()->id]));

        return redirect()->route('test-types.index', $request->query())
            ->with('message', 'Test type has been added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TestType $testType)
    {
        $courses = Course::where('status', 1)
            ->orderBy('order')
            ->get();

        return view('dashboard.test_types.show', [
            'testType' => $testType,
            'courses' => $courses,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TestType $testType)
    {
        $courses = Course::where('status', 1)
            ->orderBy('order')
            ->get();

        return view('dashboard.test_types.edit', [
            'testType' => $testType,
            'courses' => $courses,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTestTypeRequest $request, TestType $testType)
    {
        $testType->update($request->validated());

        return redirect()->route('test-types.index', $request->query())
            ->with('message', 'Test type has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TestType $testType, Request $request)
    {
        $filters = $request->input(['_token', '_method']);

        $testType->delete();

        return redirect()->route('test-types.index', $filters->query())
            ->with('message', 'Test type has been deleted.');
    }
}
