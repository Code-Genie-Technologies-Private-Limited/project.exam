<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTopicRequest;
use App\Http\Requests\UpdateTopicRequest;
use App\Models\Subject;
use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topics = Topic::with(['subject', 'creator'])
            ->join('subjects', 'topics.subject_id', '=', 'subjects.id')
            ->orderBy('subjects.order')
            ->orderBy('topics.order')
            ->select('topics.*')
            ->paginate(10);

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
        $topic->update($request->validated());

        return redirect()->route('topics.index', ['page' => $request->input('page', 1)])
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
        // if ($topic->questions()->exists()) {
        //     return redirect()->route('topics.index', ['page' => $request->input('page', 1)])
        //         ->with('error', "Can't delete. Topic has assigned one or more questions.");
        // }

        $topic->delete();

        return redirect()->route('topics.index', ['page' => $request->input('page', 1)])
            ->with('message', "Topic has been deleted.");
    }
}
