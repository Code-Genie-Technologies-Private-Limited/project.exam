<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
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
        $subjects = Subject::with('user')->paginate(20);

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
        $validation = Validator::make($request->all(), [
            'name' => 'required|min:3|max:50|string|unique:subjects,name',
            'order' => 'nullable|min:1|max:8',
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withInput()->with('subject_message', $validation->errors());
        }

        $user = auth()->user();

        $subject = new Subject();
        $subject->name = $request->input('name');
        $subject->order = $request->input('order');
        $subject->created_by = $user->id;
        $subject->save();

        return redirect()->route('subjects.index')->with('subject_message', 'Subject created successfully.');
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
        $validation = Validator::make($request->all(), [
            'name' => 'required|min:3|max:50|string',
            'order' => 'nullable|min:1|max:8',
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withInput()->with('subject_message', $validation->errors());
        }

        $subject->update($request->all());

        return redirect()->route('subjects.index')->with('subject_message', 'Subject updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();

        return redirect()->route('subjects.index')->with('subject_message', 'Subject deleted successfully.');
    }
}
