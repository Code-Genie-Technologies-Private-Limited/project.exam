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
        $topics = Topic::with('creator', 'subject')
            ->orderBy('order', 'asc')
            ->orderBy('name', 'asc')
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
        $subjects = Subject::where('status', 1)
            ->orderBy('order', 'asc')
            ->orderBy('name', 'asc')
            ->get();

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
        Topic::create(array_merge(
            $request->validated(),
            ['created_by' => auth()->user()->id]
        ));
        $request->session()->flash('message', 'Topic is create successfully.');

        return redirect()->route('topics.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function show(Topic $topic)
    {
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
        $subjects = Subject::where('status', 1)
            ->orderBy('order', 'asc')
            ->orderBy('name', 'asc')
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
        $request->session()->flash('message', 'Topic is updated successfully.');
        return redirect()->route('topics.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topic $topic, Request $request)
    {
        $topic->delete();
        $request->session()->flash('message', 'Topic is deleted successfully.');
        return redirect()->route('topics.index');
    }
}
