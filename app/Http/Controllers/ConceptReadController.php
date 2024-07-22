<?php

namespace App\Http\Controllers;

use App\Models\ConceptRead;
use App\Http\Requests\StoreConceptReadRequest;
use App\Http\Requests\UpdateConceptReadRequest;
use App\Models\Course;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;

class ConceptReadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);

        $conceptReads = ConceptRead::with('creator', 'subject', 'course')
            ->orderBy('order', 'asc')
            ->filter($request->all())
            ->paginate($perPage)
            ->appends($request->query());

        $courses = Course::orderBy('order')->get();

        $subjects = Subject::orderBy('order')->get();

        $creators = User::all();

        return view('dashboard.concept_reads.index', [

            'conceptReads' => $conceptReads,
            'courses' => $courses,
            'subjects' => $subjects,
            'creators' => $creators,
            'filters' => $request->all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $courses = Course::where('status', 1)
            ->orderBy('order', 'asc')
            ->get();

        $subjects = Subject::where('status', 1)
            ->orderBy('order', 'asc')
            ->get();

        return view('dashboard.concept_reads.create', [
            'courses' => $courses,
            'subjects' => $subjects,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreConceptReadRequest $request)
    {
        ConceptRead::create(array_merge($request->validated(), ['created_by' => auth()->user()->id]));

        return redirect()->route('concept-reads.index', $request->query())
            ->with('message', 'Concept & read has been added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ConceptRead $conceptRead, Request $request)
    {
        $courses = Course::where('status', 1)
            ->orderBy('order', 'asc')
            ->get();

        $subjects = Subject::where('status', 1)
            ->orderBy('order', 'asc')
            ->get();

        return view('dashboard.concept_reads.show', [
            'conceptRead' => $conceptRead,
            'courses' => $courses,
            'subjects' => $subjects,
            'filters' => $request->query(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ConceptRead $conceptRead, Request $request)
    {
        $courses = Course::where('status', 1)
            ->orderBy('order', 'asc')
            ->get();

        $subjects = Subject::where('status', 1)
            ->orderBy('order', 'asc')
            ->get();

        return view('dashboard.concept_reads.edit', [
            'conceptRead' => $conceptRead,
            'courses' => $courses,
            'subjects' => $subjects,
            'filters' => $request->query(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateConceptReadRequest $request, ConceptRead $conceptRead)
    {
        $conceptRead->update($request->validated());

        return redirect()->route('concept-reads.index', $request->query())
            ->with('message', 'Concept & read has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ConceptRead $conceptRead, Request $request)
    {
        $filters = $request->except('_token', '_method');
        $conceptRead->delete();

        return redirect()->route('concept-reads.index', $filters)
            ->with('message', 'Concept & read has been deleted successfully.');
    }
}
