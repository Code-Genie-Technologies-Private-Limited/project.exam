@extends('dashboard.base')

@section('content')
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Question: {{ $question->name }}</h4>
                    </div>
                    <div class="card-body">
                        <h4>Question</h4>
                        <p>{{ $question->name }}</p>
                        <h4>Subject</h4>
                        <p>{{ $question->subject->name }}</p>
                        <h4>Order</h4>
                        <h4>Topic</h4>
                        <p>{{ $question->topic->name }}</p>
                        <h4>Difficulty Level</h4>
                        <p>{{ $question->difficulty_level->type }}</p>
                        <h4>Keyword</h4>
                        <p>{{ $question->keyword->name }}</p>
                        <h4>Options</h4>
                        <p>{{ $question->options->name }}</p>
                        <h4>Answer</h4>
                        <p>{{ $question->answer->name }}</p>
                        <h4>Status</h4>
                        <p>{{ $question->status == 1 ? 'Active':'Inactive' }}</p>
                        <h4>Order</h4>
                        <p>{{ $question->order }}</p>
                        <h4>Created By</h4>
                        <p>{{ $question->creator->name }}</p>
                        <a href="{{ route('questions.index') }}" class="btn btn-primary">Return</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
@endsection