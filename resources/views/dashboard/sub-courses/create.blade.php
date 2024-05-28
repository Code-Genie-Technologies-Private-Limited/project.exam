@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Add Sub Course</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('sub-courses.store') }}">
                            @csrf
                            <div class="form-group row">
                                <label>Sub Course</label>
                                <input class="form-control" type="text" placeholder="Enter your sub course" name="name" required autofocus />
                            </div>
                            <div class="form-group row">
                                <label for="course">Course</label>
                                <select name="course_id" class="form-control" id="course" required>
                                    @foreach($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button class="btn btn-success" type="submit">Add</button>
                            <a href="{{ route('sub-courses.index') }}" class="btn btn-primary">Return</a>
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