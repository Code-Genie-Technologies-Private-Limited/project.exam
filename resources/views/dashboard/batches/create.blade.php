@extends('dashboard.base')

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Add Batch</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('batches.store') }}">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="name">Batch Name</label>
                                    <div class="col-md-9">
                                        <input class="form-control @error('name') is-invalid @enderror" id="name"
                                            type="text" name="name" placeholder="Enter Batch Name" length="160"
                                            autocomplete="batch" autofocus required value="{{ old('name') }}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="code">Batch Code</label>
                                    <div class="col-md-9">
                                        <input class="form-control @error('code') is-invalid @enderror" id="code"
                                            type="text" name="code" placeholder="Enter Batch Name" length="160"
                                            autocomplete="batch" autofocus required value="{{ old('code') }}">
                                        @error('code')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="course_id">Course</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="course_id" name="course_id">
                                            @foreach ($courses as $course)
                                                <option value="{{ $course->id }}" @selected(old('course_id') == $course->id)>
                                                    {{ $course->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('course_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="subcourse_id">SubCourse</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="subcourse_id" name="subCourse">
                                            @foreach ($subCourses as $subCourse)
                                                <option value="{{ $subCourse->id }}" @selected(old('subcourse_id') == $subCourse->id)>
                                                    {{ $subCourse->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('subcourse_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="description">Description</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description">{{ old('description') }}</textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div> --}}
                                <button class="btn btn-success" type="submit">Add</button>
                                <a href="{{ route('batches.index') }}" class="btn btn-primary">Return</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
