@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4>course: {{ $school->name }}</h4>
                    </div>
                    <div class="card-body">
                        <h4>Name</h4>
                        <p>{{ $school->name }}</p>
                        <h4>Address</h4>
                        <p>{{ $school->address }}</p>
                        <h4>Status</h4>
                        <p>{{ $school->status ==1 ? 'active':'inactive' }}</p>
                        <h4>Created By</h4>
                        <p>{{ $school->creator->name}}</p>
                        <a href="{{ route('schools.index') }}" class="btn btn-primary">Return</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')

@endsection