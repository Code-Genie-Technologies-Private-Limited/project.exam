@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4>courseSubject: {{ $courseSubject->name }}</h4>
                    </div>
                    <div class="card-body">
                        <h4>Course</h4>
                        <p>{{ $courseSubject->course->name }}</p>
                        <h4>Subject</h4>
                        <p>{{ $courseSubject->subject->name }}</p>
                        <h4>Status</h4>
                        <p>{{ $courseSubject->status ==1 ? 'active':'inactive' }}</p>
                        <h4>Created By</h4>
                        <p>{{ $courseSubject->creator->name}}</p>
                        <a href="{{ route('course-subjects.index') }}" class="btn btn-primary">Return</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')

@endsection