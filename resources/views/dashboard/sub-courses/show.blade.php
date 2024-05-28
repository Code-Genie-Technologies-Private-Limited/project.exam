@extends('dashboard.base')

@section('content')
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Sub Course: {{ $subCourse->name }}</h4>
                    </div>
                    <div class="card-body">
                        <h4>Sub Course</h4>
                        <p>{{ $subCourse->name }}</p>
                        <h4>Course</h4>
                        <p>{{ $subCourse->course->name }}</p>
                        <h4>Order</h4>
                        <p>{{ $subCourse->order }}</p>
                        <h4>Status</h4>
                        <p>{{ $subCourse->status == 1 ? 'Active':'Inactive' }}</p>
                        <h4>Created By</h4>
                        <p>{{ $subCourse->creator->name }}</p>
                        <a href="{{ route('sub-courses.index') }}" class="btn btn-primary">Return</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
@endsection