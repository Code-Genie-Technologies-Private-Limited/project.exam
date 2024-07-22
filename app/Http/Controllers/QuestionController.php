<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Models\Subject;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);

        $questions = Question::with(['creator', 'subject', 'topic'])
            ->orderBy('order', 'asc')
            ->filter($request->all())
            ->paginate($perPage)
            ->appends($request->query());

        $subjects = Subject::orderBy('order')->get();

        $topics = Topic::orderBy('order')->get();

        $creators = User::all();

        return view('dashboard.questions.index', [
            'questions' => $questions,
            'subjects' => $subjects,
            'topics' => $topics,
            'creators' => $creators,
            'filters' => $request->all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subjects = Subject::where('status', 1)
            ->orderBy('order')
            ->get();

        $topics = Topic::where('status', 1)
            ->orderBy('order')
            ->get();

        $difficultyLevels = ['Easy', 'Medium', 'Hard'];

        return view('dashboard.questions.create', compact('subjects', 'topics', 'difficultyLevels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQuestionRequest $request)
    {
        $request->validated([
            'difficulty_level' => 'required|string'
        ]);

        Question::create(array_merge($request->validated(), ['created_by' => auth()->user()->id]));

        return redirect()->route('questions.index', $request->query())
            ->with('message', 'Question has been added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question, Request $request)
    {
        $subjects = Subject::where('status', 1)
            ->orderBy('order')
            ->get();

        $topics = Topic::where('status', 1)
            ->orderBy('order')
            ->get();

        return view('dashboard.questions.show', [
            'question' => $question,
            'topics' => $topics,
            'subjects' => $subjects,
            'filters' => $request->query(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question, Request $request)
    {
        $subjects = Subject::where('status', 1)
            ->orderBy('order')
            ->get();

        $topics = Topic::where('status', 1)
            ->orderBy('order')
            ->get();

        return view('dashboard.questions.edit', [
            'question' => $question,
            'topics' => $topics,
            'subjects' => $subjects,
            'filters' => $request->query(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQuestionRequest $request, Question $question)
    {

        $question->update($request->validated());

        return redirect()->route('questions.index', $request->query())
            ->with('message', 'Question has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question, Request $request)
    {
        $filters = $request->except('_token', '_method');

        $question->delete();

        return redirect()->route('questions.index', $filters)
            ->with('message', 'Question has been deleted successfully.');
    }
}
