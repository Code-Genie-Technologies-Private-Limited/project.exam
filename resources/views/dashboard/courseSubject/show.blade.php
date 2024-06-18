@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Student: {{ $courseSubject->course_id }}</h4>
                    </div>
                    <div class="card-body">
                        <h4>Course</h4>
                        <p>{{ $courseSubject->course_id }}</p>
                        <h4>Subject</h4>
                        <p>{{ $courseSubject->subject_id }}</p>
                        <h4>Status</h4>
                        <p>{{ $courseSubject->status ==1?'Active':'Deactive' }}</p>
                        <a href="{{ route('courseSubjects.index') }}" class="btn btn-primary">Return</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')

@endsection