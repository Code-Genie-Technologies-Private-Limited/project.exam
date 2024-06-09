@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4>School: {{ $school->name }}</h4>
                    </div>
                    <div class="card-body">
                        <h5>Name</h5>
                        <p>{{ $school->name }}</p>
                        <h5>Address</h5>
                        <p>{{ $school->address }}</p>
                        <h5>Contact Person</h5>
                        <p>{{ $school->contact_person }}</p>
                        <h5>Contact Number</h5>
                        <p>{{ $school->contact_number }}</p>
                        <h5>Order</h5>
                        <p>{{ $school->order }}</p>
                        <h5>Status</h5>
                        <p>{{ $school->status == 1 ? 'Active': 'Inactive'}}</p>
                        <h5>Creator</h5>
                        <p>{{ $school->creator->name }}</p>
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