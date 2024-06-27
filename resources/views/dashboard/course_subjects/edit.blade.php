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
                        <form method="POST" action="{{ url('/course-subjects/' . $courseSubject->id) . '?' . http_build_query($filters) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="course_id">Course</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="course_id" name="course_id">
                                        @foreach($courses as $course)
                                        <option value="{{ $course->id }}" @if (( old('course_id') ?? $courseSubject->course_id) == $courseSubject->id) selected @endif > {{ $course->name }} </option>
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
                                        <option value="{{ $subject->id }}" @if (( old('subject_id') ?? $courseSubject->subject_id) == $subject->id) selected @endif > {{ $subject->name }} </option>
                                        @endforeach
                                    </select>
                                    @error('subject_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <button class="btn btn-success" type="submit">Update</button>
                            <a href="{{ url('/course-subjects?' . http_build_query($filters)) }}" class="btn btn-secondary">Back to list</a>
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