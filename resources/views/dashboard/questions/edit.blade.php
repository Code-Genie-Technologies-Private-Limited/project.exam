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
                                <input class="form-control" type="text" placeholder="Enter your question" name="name" required autofocus value="{{ $question->name }}" />
                            </div>
                            <div class="form-group row">
                                <label for="subject">Subject</label>
                                <select name="subject_id" class="form-control" id="subject" required>
                                    @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}" {{ $subject->id == $question->subject_id ? 'selected' : '' }}>{{ $subject->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group row">
                                <label for="topic">Topic</label>
                                <select name="topic_id" class="form-control" id="topic" required>
                                    @foreach($topics as $topic)
                                    <option value="{{ $topic->id }}" {{ $topic->id == $question->topic_id ? 'selected' : '' }}>{{ $topic->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Status</label>
                                <div class="col-md-9 col-form-label">
                                    <div class="form-check">
                                        <input class="form-check-input" id="active" type="radio" value="1" name="status" {{$question->status == 1 ? 'checked':''}}>
                                        <label class="form-check-label" for="active">Active</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" id="inactive" type="radio" value="0" name="status" {{$question->status == 0 ? 'checked':'' }}>
                                        <label class="form-check-label" for="inactive">Inactive</label>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label for="difficulty_level">DifficultyLevel:</label>
                                <select id="difficulty_level" name="difficulty_level" required>
                                    @foreach(\App\Enums\DifficultyLevel::cases() as $difficulty)
                                    <option value="{{ $difficulty_level->value }}">{{ ucfirst($difficulty->value) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group row">
                                <label>Order</label>
                                <input class="form-control" type="text" placeholder="order" name="order" required value="{{ $question->order }}" />
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