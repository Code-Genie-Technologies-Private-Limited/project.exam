<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTopicRequest;
use App\Http\Requests\UpdateTopicRequest;
use App\Models\Subject;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topics = Topic::with(['subject', 'creator'])->paginate(10);
        return view('dashboard.topics.index', compact('topics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects = Subject::where('status', 1)->orderBy('order')->get();
        return view('dashboard.topics.create', compact('subjects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTopicRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTopicRequest $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:1|max:160',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Topic::create(array_merge($request->validated(), ['created_by' => auth()->user()->id]));

        return redirect()->route('topics.index')
            ->with('message', 'Topic created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function show(Topic $topic)
    {
        $subjects = Subject::where('status', 1)->orderBy('order')->get();
        return view('dashboard.topics.show', compact('topic', 'subjects'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function edit(Topic $topic)
    {
        $subjects = Subject::where('status', 1)
            ->orWhere('id', $topic->subject_id)
            ->orderBy('order')
            ->get();

        return view('dashboard.topics.edit', compact('topic', 'subjects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTopicRequest  $request
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTopicRequest $request, Topic $topic)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:1|max:160',
            'subject_id' => 'required|exists:subjects,id',
            'order' => 'decimal:2',
            'status' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $topic->update($request->validated());

        return redirect()->route('topics.index')
            ->with('message', 'Topic updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topic $topic, Request $request)
    {
        // Flash an error message and redirect if the subject has any related questions
        // if ($topic->questions()->exists()) {
        //     return redirect()->route('topics.index')
        //         ->with('error', "Can't delete. Topic has assigned one or more questions.");
        // }

        $topic->delete();

        return redirect()->route('topics.index')
            ->with('message', "Topic has been deleted.");
    }
}