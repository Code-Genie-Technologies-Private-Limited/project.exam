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
                                <label>Questions</label>
                                <input class="form-control" type="text" placeholder="Question" name="name" required autofocus />
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="subject">Subject</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="subject_id" name="subject_id">
                                        @foreach($subjects as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="topic">Topic</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="topic_id" name="topic_id">
                                        @foreach($topics as $topic)
                                        <option value="{{ $topic->id }}">{{ $topic->name }}</option>
                                        @endforeach
                                    </select>
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

@section('javascript')
@endsection