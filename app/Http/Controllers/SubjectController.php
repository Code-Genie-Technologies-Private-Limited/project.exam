<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::with('creator')->paginate(10);
        return view('dashboard.subjects.index', compact('subjects'));
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:1|max:64',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Subject::create(array_merge($request->all(), ['created_by' => auth()->user()->id]));

        $request->session()->flash('message', 'Successfully created subject.');
        return redirect()->route('subjects.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        return view('dashboard.subjects.show', compact('subject'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        return view('dashboard.subjects.edit', compact('subject'));
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:1|max:64',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $subject->update($request->all());

        $request->session()->flash('message', 'Subject successfully updated.');
        return redirect()->route('subjects.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject, Request $request)
    {
        // Check if the subject has any related topics
        $hasTopics = $subject->topics()->exists();

        // Flash an error message and redirect if the subject has topics
        if ($hasTopics) {
            $request->session()->flash('error', "Can't delete. Subject has assigned one or more topics.");
            return redirect()->route('subjects.index');
        }

        $subject->delete();

        $request->session()->flash('message', "Subject has been deleted.");
        return redirect()->route('subjects.index');
    }
}
