@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Teacher: {{ $teacher->name }}</h4>
                    </div>
                    <div class="card-body">
                        <h5>Teacher Name</h5>
                        <p>{{ $teacher->name }}</p>
                        <h5>School Name</h5>
                        <p>{{ $teacher->school->name }}</p>
                        <h5>Address</h5>
                        <p>{{ $teacher->address }}</p>
                        <h5>Order</h5>
                        <p>{{ $teacher->order }}</p>
                        <h5>Status</h5>
                        <p>{{ $teacher->status == 1 ? 'Active': 'Inactive'}}</p>
                        <h5>Creator</h5>
                        <p>{{ $teacher->creator->name }}</p>
                        <a href="{{ route('teachers.index') }}" class="btn btn-primary">Return</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')

@endsection