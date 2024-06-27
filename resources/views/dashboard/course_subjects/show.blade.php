@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Course Subject: {{ $courseSubject->name }}</h4>
                    </div>
                    <div class="card-body">
                        <h4>Subject Name</h4>
                        <p>{{ $courseSubject->subject->name }}</p>
                        <h4>Course Name</h4>
                        <p>{{ $courseSubject->course->name }}</p>
                        <h4>Creator</h4>
                        <p>{{ $courseSubject->creator->name }}</p>
                        <a href="{{ url('/course-subjects/' . $courseSubject->id . '/edit') . '?' . http_build_query($filters) }}" class="btn btn-primary">Edit</a>
                        <a href="{{ url('/course-subjects?' . http_build_query($filters)) }}" class="btn btn-secondary">Back to list</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')

@endsection