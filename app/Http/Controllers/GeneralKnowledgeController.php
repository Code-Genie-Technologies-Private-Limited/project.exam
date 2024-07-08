<?php

namespace App\Http\Controllers;

use App\Models\GeneralKnowledge;
use App\Http\Requests\StoreGeneralKnowledgeRequest;
use App\Http\Requests\UpdateGeneralKnowledgeRequest;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class GeneralKnowledgeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);

        $generalKnowledges = GeneralKnowledge::with(['creator', 'course'])
            ->orderBy('order', 'asc')
            ->filter($request->all())
            ->paginate($perPage)
            ->appends($request->query());

        $courses = Course::where('status', 1)
            ->orderBy('order')
            ->get();

        $creators = User::all();

        return view('dashboard.general_knowledges.index', [
            'generalKnowledges' => $generalKnowledges,
            'courses' => $courses,
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
            ->orderBy('order')
            ->get();

        return view('dashboard.general_knowledges.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGeneralKnowledgeRequest $request)
    {
        GeneralKnowledge::create(array_merge($request->validated(), ['created_by' => auth()->user()->id]));

        return redirect()->route('general-knowledges.index', $request->query())
            ->with('message', 'General & knowledge has been added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(GeneralKnowledge $generalKnowledge, Request $request)
    {
        $courses = Course::where('status', 1)
            ->orderBy('order')
            ->get();

        return view('dashboard.general_knowledges.show', [
            'generalKnowledge' => $generalKnowledge,
            'courses' => $courses,
            'filters' => $request->query(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GeneralKnowledge $generalKnowledge, Request $request)
    {
        $courses = Course::where('status', 1)
            ->orderBy('order')
            ->get();

        return view('dashboard.general_knowledges.edit', [
            'generalKnowledge' => $generalKnowledge,
            'courses' => $courses,
            'filters' => $request->query(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGeneralKnowledgeRequest $request, GeneralKnowledge $generalKnowledge)
    {
        $generalKnowledge->update($request->validated());

        return redirect()->route('general-knowledges.index', $request->query())
            ->with('message', 'General & knowledge has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GeneralKnowledge $generalKnowledge, Request $request)
    {

        $filters = $request->except('_token', '_method');
        $generalKnowledge->delete();

        return redirect()->route('general-knowledges.index', $filters)
            ->with('message', 'General & knowledge has been deleted.');
    }
}
