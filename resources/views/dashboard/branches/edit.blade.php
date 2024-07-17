@extends('dashboard.base')

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Branch</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST"
                                action="{{ url('/branches/' . $branch->id) . '?' . http_build_query($filters) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="branch_code">Branch Code</label>
                                    <div class="col-md-9">
                                        <input class="form-control @error('branch_code') is-invalid @enderror"
                                            id="branch_code" type="text" name="branch_code" placeholder="Enter branch..."
                                            length="160" autocomplete="branch" autofocus required
                                            value="{{ old('branch_code') ?? $branch->branch_code }}">
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
                                            value="{{ old('branch_name') ?? $branch->branch_name }}">
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
                                            value="{{ old('start_date') ?? $branch->start_date }}">
                                        @error('start_date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="title">Branch</label>
                                    <div class="col-md-9">
                                        <input class="form-control" id="title" type="text" name="title"
                                            length="160" placeholder="Enter branch..." autocomplete="branch" autofocus
                                            required value="{{ old('title') ?? $branch->title }}">
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="content">Content</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content">{{ old('content') ?? $branch->content }}</textarea>
                                        @error('content')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="description">Description</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description">{{ old('description') ?? $branch->description }}</textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div> --}}
                                {{-- <div class="form-group row">
                                    <label for="user" class="col-md-3 col-form-label">Creator</label>
                                    <div class="col-md-9">
                                        <select name="user" id="user" class="form-control">
                                            <option value="">All</option>
                                            @foreach ($creators as $creator)
                                                <option value="{{ $creator->id }}"
                                                    {{ ($filters['user'] ?? '') == $creator->id ? 'selected' : '' }}>
                                                    {{ $creator->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}
                                {{-- <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="difficulty_level">Difficulty Level</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="difficulty_level" name="difficulty_level">
                                            <option value="easy" @if ((old('difficulty_level') ?? $branch->difficulty_level) == 'easy') selected @endif>Easy
                                            </option>
                                            <option value="medium" @if ((old('difficulty_level') ?? $branch->difficulty_level) == 'medium') selected @endif>Medium
                                            </option>
                                            <option value="hard" @if ((old('difficulty_level') ?? $branch->difficulty_level) == 'hard') selected @endif>Hard
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="topic_id">Topic</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="topic_id" name="topic_id">
                                            @foreach ($topics as $topic)
                                                <option value="{{ $topic->id }}"
                                                    @if ((old('topic_id') ?? $branch->topic_id) == $topic->id) selected @endif> {{ $topic->name }}
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
                                                    @if ((old('subject_id') ?? $branch->subject_id) == $subject->id) selected @endif> {{ $subject->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('subject_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div> --}}
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="order">Priority Order</label>
                                    <div class="col-md-9">
                                        <input class="form-control" id="order" type="number" name="order"
                                            placeholder="Enter Priority Order" step="0.01"
                                            value="{{ old('order', number_format($branch->order, 2)) }}">
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
                                                name="status" @checked(old('status', $branch->status) == 1)>
                                            <label class="form-check-label" for="active">Active</label>
                                        </div>
                                        <div class="form-check form-check-inline mr-1">
                                            <input class="form-check-input" id="in-active" type="radio" value="0"
                                                name="status" @checked(old('status', $branch->status) == 0)>
                                            <label class="form-check-label" for="in-active">In Active</label>
                                        </div>
                                        @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <button class="btn btn-success" type="submit">Update</button>
                                <a href="{{ url('/branches?' . http_build_query($filters)) }}"
                                    class="btn btn-secondary">Back
                                    to list</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
