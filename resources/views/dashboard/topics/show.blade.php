@extends('dashboard.base')

@section('content')
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Topic: {{ $topic->name }}</h4>
                    </div>
                    <div class="card-body">
                        <h4>Name</h4>
                        <p>{{ $topic->name }}</p>
                        <h4>Subject Id</h4>
                        <p>{{ $topic->subject_id }}</p>
                        <h4>Order</h4>
                        <p>{{ $topic->order }}</p>
                        <h4>Status</h4>
                        <p>{{ $topic->status }}</p>
                        <h4>Created By</h4>
                        <p>{{ $topic->created_by }}</p>
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