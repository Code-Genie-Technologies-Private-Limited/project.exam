<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
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
        $subjects = Subject::with('creator')
            ->orderBy('id', 'desc')
            ->paginate(4);

        return view('dashboard.subject.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subject = Subject::all();
        return view('dashboard.Subject.create', compact('subject'));
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
            'name' => 'required|unique:subjects|min:3|max:200',
        ]);

        if ($validator->fails()) {
            // return response()->json(['errors' => $validator->errors()], 422);
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Subject::create(array_merge($request->all(), ['created_by' => auth()->user()->id]));
        $request->session()->flash('message', 'Subject Created Successfully');
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

        return view('dashboard.Subject.show', compact('subject'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {

        return view('dashboard.Subject.edit', compact('subject'));
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
            'name' => 'required|min:3|max:200',
        ]);

        if ($validator->fails()) {
            // return response()->json(['errors' => $validator->errors()], 422);
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $request->session()->flash('message', "update Successfully");
        $subject->update($request->all());
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
        $subject->delete();
        $request->session()->flash('message', 'Subject Delete Successfully !');
        return redirect()->route('subjects.index');
    }
}
