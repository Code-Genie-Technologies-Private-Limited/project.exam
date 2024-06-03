@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4>subject: {{ $subject->name }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <b>Name</b>
                            </div>
                            <div class="col-9">
                                <p>{{ $subject->name }}</p>
                            </div>
                            <div class="col-3">
                                <b>Order</b>
                            </div>
                            <div class="col-9">
                                <p>{{ $subject->order }}</p>
                            </div>
                            <div class="col-3">
                                <b>Status</b>
                            </div>
                            <div class="col-9">
                                <p>{{ $subject->status==1?'Active':'Deactive'; }}</p>
                            </div>
                            <div class="col-3">
                                <b>Created By</b>
                            </div>
                            <div class="col-9">
                                <p>{{ $subject->creator->name }}</p>
                            </div>
                            <div class="col-6">
                                <a href="{{ route('subjects.index') }}" class="btn btn-primary">Return</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')

@endsection