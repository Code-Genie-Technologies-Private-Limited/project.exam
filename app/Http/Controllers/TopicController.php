<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Http\Requests\StoreTopicRequest;
use App\Http\Requests\UpdateTopicRequest;
use App\Models\Subject;
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
        $topics = Topic::with(['user', 'subject'])->orderBy('order', 'asc')->paginate(20);

        return view('dashboard.topics.index', compact('topics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects = Subject::query()->get();
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
        $validation = Validator::make($request->all(), [
            'name' => 'required|min:3|max:50|string|unique:topics,name',
            'order' => 'nullable|min:1|max:8',
            'subject_id' => 'required|integer',
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withInput()->with('topic_message', $validation->errors());
        }

        $user = auth()->user();

        $topic = new Topic();
        $topic->name = $request->input('name');
        $topic->subject_id = $request->input('subject_id');
        $topic->order = $request->input('order');
        $topic->created_by = $user->id;
        $topic->save();

        return redirect()->route('topics.index')->with('topic_message', 'Topic created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function show(Topic $topic)
    {
        $topic->with(['subject', 'user'])->get();
        return view('dashboard.topics.show', compact('topic'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function edit(Topic $topic)
    {
        $topic->with('subject')->get();
        $subjects = Subject::query()->get();
        return view('dashboard.topics.edit', compact(['topic', 'subjects']));
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
        $validation = Validator::make($request->all(), [
            'name' => 'required|min:3|max:50|string',
            'order' => 'nullable|min:1|max:8',
            'subject_id' => 'required|integer',
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withInput()->with('topic_message', $validation->errors());
        }

        $topic->update($request->all());

        return redirect()->route('topics.index')->with('topic_message', 'Topic updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topic $topic)
    {
        $topic->delete();
        return redirect()->route('topics.index')->with('topic_message', 'Topic deleted successfully.');
    }
}
