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
                            <h4>Topic</h4>
                            <p>{{ $question->topic->name }}</p>
                            <h4>Subject</h4>
                            <p>{{ $question->subject->name }}</p>
                            <h4>Difficulty Level</h4>
                            <p>{{ $question->difficulty_level }}</p>
                            <h4>Order</h4>
                            <p>{{ $question->order }}</p>
                            <h4>Status</h4>
                            <p>{{ $question->status == 1 ? 'Active' : 'In Active' }}</p>
                            <h4>Created By User</h4>
                            <p>{{ $question->creator->name }}</p>
                            <a href="{{ url('/questions/' . $question->id . '/edit') . '?' . http_build_query($filters) }}"
                                class="btn btn-primary">Edit</a>
                            <a href="{{ url('/questions?' . http_build_query($filters)) }}" class="btn btn-secondary">Back to
                                list</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection