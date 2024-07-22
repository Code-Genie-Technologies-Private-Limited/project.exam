@extends('dashboard.base')

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Add Branch</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('branches.store') }}">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="branch_code">Branch Code</label>
                                    <div class="col-md-9">
                                        <input class="form-control @error('branch_code') is-invalid @enderror"
                                            id="branch_code" type="text" name="branch_code" placeholder="Enter branch..."
                                            length="160" autocomplete="branch" autofocus required
                                            value="{{ old('branch_code') }}">
                                        @error('branch_code')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="branch_name">Branch Name</label>
                                    <div class="col-md-9">
                                        <input class="form-control @error('branch_name') is-invalid @enderror"
                                            id="branch_name" type="text" name="branch_name" placeholder="Enter branch..."
                                            length="160" autocomplete="branch" autofocus required
                                            value="{{ old('branch_name') }}">
                                        @error('branch_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="start_date">Start Date</label>
                                    <div class="col-md-9">
                                        <input class="form-control @error('start_date') is-invalid @enderror"
                                            id="start_date" type="date" name="start_date" placeholder="Enter Date"
                                            length="11" autocomplete="branch" autofocus required
                                            value="{{ old('start_date') }}">
                                        @error('start_date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="content">Content</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content">{{ old('content') }}</textarea>
                                        @error('content')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="description">Description</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description">{{ old('description') }}</textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div> --}}
                                {{-- <div class="form-group row">
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
                                </div> --}}
                                <button class="btn btn-success" type="submit">Add</button>
                                <a href="{{ route('branches.index') }}" class="btn btn-primary">Return</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
