@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Course Subject</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('course-subjects.update', $courseSubject->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="course_id">Course</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="course_id" name="course_id">
                                        @foreach($courses as $course)
                                        <option value="{{ $course->id }}" {{$courseSubject->course_id == $course->id ? 'selected': ''}}>{{ $course->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('course_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="subject_id">Subject</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="subject_id" name="subject_id">
                                        @foreach($subjects as $subject)
                                        <option value="{{ $subject->id }}" {{ $courseSubject->subject_id == $subject->id ? 'selected': ''}}>{{ $subject->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('subject_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Status</label>
                                <div class="col-md-9 col-form-label">
                                    <div class="form-check">
                                        <input class="form-check-input" id="Active" type="radio" value="1" name="status" {{ $courseSubject->status == 1 ? 'checked': '' }}>
                                        <label class="form-check-label" for="Active">Active</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" id="Inactive" type="radio" value="0" name="status" {{ $courseSubject->status == 0 ? 'checked': '' }}>
                                        <label class="form-check-label" for="Inactive">Inactive</label>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-success" type="submit">Update</button>
                            <a href="{{ route('course-subjects.index') }}" class="btn btn-primary">Return</a>
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