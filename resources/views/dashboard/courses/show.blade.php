@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Course: {{ $course->name }}</h4>
                    </div>
                    <div class="card-body">
                        <h5>Name</h5>
                        <p>{{ $course->name }}</p>
                        <h5>Order</h5>
                        <p>{{ $course->order }}</p>
                        <h5>Status</h5>
                        <p>{{ $course->status == 1 ? 'Active': 'Inactive'}}</p>
                        <h5>Creator</h5>
                        <p>{{ $course->creator->name }}</p>
                        <a href="{{ route('courses.index') }}" class="btn btn-primary">Return</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')

@endsection