@extends('dashboard.base')

@section('content')
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Subject: {{ $subject->name }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <h5>Name</h5>
                            </div>
                            <div class="col-9">
                                <p>{{ $subject->name }}</p>
                            </div>
                            <div class="col-3">
                                <h5>Order</h5>
                            </div>
                            <div class="col-9">
                                <p>{{ $subject->order }}</p>
                            </div>
                            <div class="col-3">
                                <h5>Status</h5>
                            </div>
                            <div class="col-9">
                                <p>{{ $subject->status == 1 ? 'Active':'Inactive' }}</p>
                            </div>
                            <div class="col-3">
                                <h5>Created By</h5>
                            </div>
                            <div class="col-9">
                                <p>{{ $subject->creator->name }}</p>
                            </div>
                                <a href="{{ route('subjects.index') }}" class="btn btn-primary">Return</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

    @section('javascript')
    @endsection