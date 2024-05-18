@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Topic</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('topics.update', $topic->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="name">Topic Name</label>
                                <div class="col-md-9">
                                    <input class="form-control" id="name" type="text" name="name" placeholder="Enter Topic Name" autocomplete="topic" autofocus required value="{{ $topic->name }}">
                                    <span class="help-block">Please enter topic name</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="subject_id">Subject</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="subject_id" name="subject_id">
                                        @foreach($subjects as $subject)
                                        <option value="{{ $subject->id }}" {{ $subject->id == $topic->subject_id ? 'selected' : '' }}>{{ $subject->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="order">Priority Order</label>
                                <div class="col-md-9">
                                    <input class="form-control" id="order" type="text" name="order" placeholder="Enter Priority Order" value="{{ $topic->order }}">
                                    <span class="help-block">Please enter priority order</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Status</label>
                                <div class="col-md-9 col-form-label">
                                    <div class="form-check form-check-inline mr-1">
                                        <input class="form-check-input" id="active" type="radio" value="1" name="status" {{ $subject->status == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="active">Active</label>
                                    </div>
                                    <div class="form-check form-check-inline mr-1">
                                        <input class="form-check-input" id="in-active" type="radio" value="0" name="status" {{ $subject->status == 0 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="in-active">In Active</label>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-success" type="submit">Update</button>
                            <a href="{{ route('topics.index') }}" class="btn btn-primary">Return</a>
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