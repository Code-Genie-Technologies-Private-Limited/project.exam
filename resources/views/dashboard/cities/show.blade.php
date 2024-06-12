@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4>City: {{ $city->name }}</h4>
                    </div>
                    <div class="card-body">
                        <h4>Name</h4>
                        <p>{{ $city->name }}</p>
                        <h4>Address</h4>
                        <p>{{ $city->address }}</p>
                        <h4>Status</h4>
                        <p>{{ $city->status ==1 ? 'active':'inactive' }}</p>
                        <h4>Created By</h4>
                        <p>{{ $city->creator->name}}</p>
                        <a href="{{ route('cities.index') }}" class="btn btn-primary">Return</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')

@endsection