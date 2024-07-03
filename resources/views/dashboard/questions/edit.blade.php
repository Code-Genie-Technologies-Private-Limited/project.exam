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
                            <form method="POST"
                                action="{{ url('/questions/' . $question->id) . '?' . http_build_query($filters) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="name">Question</label>
                                    <div class="col-md-9">
                                        <input class="form-control" id="name" type="text" name="name"
                                            placeholder="Enter question..." autocomplete="question" autofocus required
                                            value="{{ old('name') ?? $question->name }}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                          <label class="col-md-3 col-form-label" for="select1">Difficulty Level</label>
                          <div class="col-md-9">
                            <select class="form-control" id="select1" name="select1">
                              <option value="0">Please select</option>
                              <option value="1">Easy</option>
                              <option value="2">Medium</option>
                              <option value="3">Hard</option>
                            </select>
                          </div>
                        </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="topic_id">Topic</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="topic_id" name="topic_id">
                                            @foreach ($topics as $topic)
                                                <option value="{{ $topic->id }}"
                                                    @if ((old('topic_id') ?? $question->topic_id) == $topic->id) selected @endif> {{ $topic->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('topic_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="subject_id">Subject</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="subject_id" name="subject_id">
                                            @foreach ($subjects as $subject)
                                                <option value="{{ $subject->id }}"
                                                    @if ((old('subject_id') ?? $question->subject_id) == $subject->id) selected @endif> {{ $subject->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('subject_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="order">Priority Order</label>
                                    <div class="col-md-9">
                                        <input class="form-control" id="order" type="number" name="order"
                                            placeholder="Enter Priority Order" step="0.01"
                                            value="{{ old('order', number_format($question->order, 2)) }}">
                                        @error('order')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Status</label>
                                    <div class="col-md-9 col-form-label">
                                        <div class="form-check form-check-inline mr-1">
                                            <input class="form-check-input" id="active" type="radio" value="1"
                                                name="status" @checked(old('status', $question->status) == 1)>
                                            <label class="form-check-label" for="active">Active</label>
                                        </div>
                                        <div class="form-check form-check-inline mr-1">
                                            <input class="form-check-input" id="in-active" type="radio" value="0"
                                                name="status" @checked(old('status', $question->status) == 0)>
                                            <label class="form-check-label" for="in-active">In Active</label>
                                        </div>
                                        @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <button class="btn btn-success" type="submit">Update</button>
                                <a href="{{ url('/questions?' . http_build_query($filters)) }}" class="btn btn-secondary">Back
                                    to list</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
