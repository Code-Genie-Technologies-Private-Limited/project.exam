@extends('dashboard.base')

@section('content')
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Question</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('questions.update', $question->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label>Question</label>
                                <input class="form-control" type="text" placeholder="Question" name="name" required autofocus value="{{ $question->name }}" />
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="subject">Subject</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="subject_id" name="subject_id">
                                        @foreach($subjects as $subject)
                                        <option value="">{{ $subject->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="subject">Topic</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="topic_id" name="topic_id">
                                        @foreach($topics as $topic)
                                        <option value="">{{ $topic->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label> Order</label>
                                <input class="form-control" type="number" step="0.01" placeholder="Order" name="order" required value="{{ $question->order }}" />
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Status</label>
                                <div class="col-md-9 col-form-label">
                                    <div class="form-check">
                                        <input class="form-check-input" id="active" type="radio" value="1" name="status" {{$question->status == 1? 'checked':''}}>
                                        <label class="form-check-label" for="active">Active</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" id="inactive" type="radio" value="0" name="status" {{$question->status == 0? 'checked':''}}>
                                        <label class="form-check-label" for="inactive">Inactive</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Difficulty Level</label>
                                <div class="col-md-9 col-form-label">
                                    <div class="form-check">
                                        <input class="form-check-input" id="easy" type="radio" value="1" name="status" {{$question->status == 1? 'checked':''}}>
                                        <label class="form-check-label" for="easy">Easy</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" id="medium" type="radio" value="0" name="status" {{$question->status == 0? 'checked':''}}>
                                        <label class="form-check-label" for="medium">Medium</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" id="hard" type="radio" value="2" name="status" {{$question->status == 2? 'checked':''}}>
                                        <label class="form-check-label" for="hard">Hard</label>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-success" type="submit">Update</button>
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