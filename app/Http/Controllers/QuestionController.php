<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Models\Question;
use App\Models\Subject;
use App\Models\Topic;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::with('subject', 'topic')
            ->orderBy('name', 'desc')
            ->orderBy('order')
            ->paginate(10);

        return view('dashboard.questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects = Subject::where('status', 1)
            ->orderBy('order', 'desc')
            ->orderBy('name')
            ->get();

        $topics = Topic::where('status', 1)
            ->orderBy('order', 'desc')
            ->orderBy('name')
            ->get();

        return view('dashboard.questions.create', compact('subjects', 'topics'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreQuestionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuestionRequest $request)
    {
        Question::create(array_merge(
            $request->validated(),
            ['created_by' => auth()->user()->id]
        ));
        return session()->flash('message', 'question is created successfully.');
        return redirect()->route('questions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        return view('dashboard.questions.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        $subjects = Subject::where('status', 1)
            ->orderBy('order', 'desc')
            ->orderBy('name')
            ->get();

        $topics = Topic::where('status', 1)
            ->orderBy('name', 'desc')
            ->orderBy('order')
            ->get();

        return view('dashboard.questions.edit', compact('subjects', 'topics'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateQuestionRequest  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQuestionRequest $request, Question $question)
    {
        $question->update($request->validated());
        return session()->flash('message', 'Question is updated successfully.');
        return redirect()->route('questions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return session()->flash('error', 'Question is deleted successfully.');
        return redirect()->route('questions.index');
    }
}
