<?php

namespace App\Http\Controllers;

use App\Models\PreviousYearPaper;
use App\Http\Requests\StorePreviousYearPaperRequest;
use App\Http\Requests\UpdatePreviousYearPaperRequest;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class PreviousYearPaperController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);

        $previousYearPapers = PreviousYearPaper::with(['creator', 'course'])
            ->orderBy('order', 'desc')
            ->filter($request->all())
            ->paginate($perPage)
            ->appends($request->query());

        $courses = Course::where('status', 1)
            ->orderBy('order')
            ->get();

        $creators = User::all();

        return view('dashboard.previous_year_papers.index', [
            'previousYearPapers' => $previousYearPapers,
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
        return view('dashboard.previous_year_papers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePreviousYearPaperRequest $request)
    {
        $courses = Course::where('status', 1)
            ->orderBy('order')
            ->get();

        $creators = User::all();

        PreviousYearPaper::create(array_merge($request->validated(), ['created_by' => auth()->user()->id]));

        return redirect()->route('prevoius-year-papers.index', [
            'courses' => $courses,
            'creators' => $creators,
            'filters' => $request->query(),
        ])->with('message', 'Prevoius year paper has been added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PreviousYearPaper $previousYearPaper, Request $request)
    {
        $courses = Course::where('status', 1)
            ->orderBy('order')
            ->get();

        $creators = User::all();

        return view('dashboard.previous_year_papers.show', [
            'previousYearPaper' => $previousYearPaper,
            'courses' => $courses,
            'creators' => $creators,
            'filters' => $request->query(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PreviousYearPaper $previousYearPaper, Request $request)
    {
        $courses = Course::where('status', 1)
            ->orderBy('order')
            ->get();

        $creators = User::all();

        return view('dashboard.previous_year_papers.edit', [
            'previousYearPaper' => $previousYearPaper,
            'courses' => $courses,
            'creators' => $creators,
            'filters' => $request->query(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePreviousYearPaperRequest $request, PreviousYearPaper $previousYearPaper)
    {
        $previousYearPaper->update($request->validated());

        return redirect()->route('prevoius-year-papers.index', $request->query())
            ->with('message', 'Prevoius year paper has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PreviousYearPaper $previousYearPaper, Request $request)
    {
        $filters = $request->input(['_token', '_method']);

        $previousYearPaper->delete();

        return redirect()->route('prevoius-year-papers.index', $filters)
            ->with('message', 'Previous year paper has been deleted.');
    }
}
