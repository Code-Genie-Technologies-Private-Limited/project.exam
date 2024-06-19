@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Add SubCourse</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('sub-courses.store') }}">
                            @csrf
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="name">SubCourse Name</label>
                                <div class="col-md-9">
                                    <input class="form-control @error('name') is-invalid @enderror" id="name" type="text" name="name" placeholder="Enter sub-course..." length="160" autocomplete="sub-course" autofocus required value="{{ old('name') }}">
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="course-id">Subject</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="course-id" name="course-id">
                                        @foreach($courses as $course)
                                        <option value="{{ $course->id }}" @selected( old('course-id')==$course->id)>{{ $course->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('course-id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
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