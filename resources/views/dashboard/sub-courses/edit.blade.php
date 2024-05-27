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
                        <form method="POST" action="{{ route('sub-courses.update', $subCourse->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="name">Sub Course Name</label>
                                <div class="col-md-9">
                                    <input class="form-control" id="name" type="text" name="name" placeholder="Enter Sub Course Name" autocomplete="subCourse" autofocus required value="{{ old('name') ?? $subCourse->name }}">
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="course_id">Course</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="course_id" name="course_id">
                                        @foreach($courses as $course)
                                        <option value="{{ $course->id }}" @if (( old('course_id') ?? $subCourse->course_id) == $course->id) selected @endif > {{ $course->name }} </option>
                                        @endforeach
                                    </select>
                                    @error('course_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="order">Priority Order</label>
                                <div class="col-md-9">
                                    <input class="form-control" id="order" type="number" name="order" placeholder="Enter Priority Order" value="{{ old('order') ?? $course->order }}">
                                    @error('order')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Status</label>
                                <div class="col-md-9 col-form-label">
                                    <div class="form-check form-check-inline mr-1">
                                        <input class="form-check-input" id="active" type="radio" value="1" name="status" @checked(old('status', $subCourse->status == 1))>
                                        <label class="form-check-label" for="active">Active</label>
                                    </div>
                                    <div class="form-check form-check-inline mr-1">
                                        <input class="form-check-input" id="in-active" type="radio" value="0" name="status" @checked(old('status', $subCourse->status == 0))>
                                        <label class="form-check-label" for="in-active">In Active</label>
                                    </div>
                                    @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <button class="btn btn-success" type="submit">Update</button>
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