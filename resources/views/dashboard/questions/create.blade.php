@extends('dashboard.base')

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Add Question</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('questions.store') }}">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="name">Question</label>
                                    <div class="col-md-9">
                                        <input class="form-control @error('name') is-invalid @enderror" id="name"
                                            type="text" name="name" placeholder="Enter question..." length="160"
                                            autocomplete="question" autofocus required value="{{ old('name') }}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="difficulty_level">Difficulty Level</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="difficulty_level" name="difficulty_level">
                                            <option value="Easy">Easy</option>
                                            <option value="Medium">Medium</option>
                                            <option value="Hard">Hard</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="subject_id">Subject</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="subject_id" name="subject_id">
                                            @foreach ($subjects as $subject)
                                                <option value="{{ $subject->id }}" @selected(old('subject_id') == $subject->id)>
                                                    {{ $subject->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('subject_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="topic_id">Topic</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="topic_id" name="topic_id">
                                            @foreach ($topics as $topic)
                                                <option value="{{ $topic->id }}" @selected(old('topic_id') == $topic->id)>
                                                    {{ $topic->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('topic_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <button class="btn btn-success" type="submit">Add</button>
                                <a href="{{ route('questions.index') }}" class="btn btn-primary">Return</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
