@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Student: {{ $phone->name }}</h4>
                    </div>
                    <div class="card-body">
                        <h4>Name</h4>
                        <p>{{ $phone->name }}</p>
                        <h4>Order</h4>
                        <p>{{ $phone->order }}</p>
                        <h4>Status</h4>
                        <p>{{ $phone->status ==1?'Active':'Deactive' }}</p>
                        <a href="{{ route('phones.index') }}" class="btn btn-primary">Return</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')

@endsection