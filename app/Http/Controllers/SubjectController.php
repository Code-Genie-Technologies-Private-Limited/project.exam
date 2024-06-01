<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $subjects = Subject::filter($request->all())->with('creator')->orderBy('order')->paginate(10);
        $creators = User::all();

        return view('dashboard.subjects.index', [
            'subjects' => $subjects,
            'creators' => $creators,
            'filters' => $request->all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.subjects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSubjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubjectRequest $request)
    {
        Subject::create(array_merge($request->validated(), ['created_by' => auth()->user()->id]));

        return redirect()->route('subjects.index')
            ->with('message', 'Successfully created subject.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject, Request $request)
    {
        return view('dashboard.subjects.show', [
            'subject' => $subject,
            'filters' => $request->query(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject, Request $request)
    {
        return view('dashboard.subjects.edit', [
            'subject' => $subject,
            'filters' => $request->query(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSubjectRequest  $request
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubjectRequest $request, Subject $subject)
    {
        $subject->update($request->validated());

        return redirect()->route('subjects.index', ['filters' => $request->query()])
            ->with('message', 'Subject successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject, Request $request)
    {
        if ($subject->topics()->exists()) {
            return redirect()->route('subjects.index', ['filters' => $request->query()])
                ->with('error', "Can't delete. Subject has assigned one or more topics.");
        }

        $subject->delete();

        return redirect()->route('subjects.index', ['filters' => $request->query()])
            ->with('message', 'Subject has been deleted.');
    }
}
