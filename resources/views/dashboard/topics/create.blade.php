@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Add Topic</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('topics.store') }}">
                            @csrf
                            <div class="form-group row">
                                <label>Topic</label>
                                <input class="form-control" type="text" placeholder="Enter your topic" name="name" required autofocus />
                            </div>
                            <div class="form-group row">
                                <label for="subject">Subject</label>
                                <select name="subject_id" class="form-control" id="subject" required>
                                    @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button class="btn btn-success" type="submit">Add</button>
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