@extends('dashboard.base')

@section('content')
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Title: {{ $notice->title }}</h4>
                    </div>
                    <div class="card-body">
                        <h4>Title</h4>
                        <p>{{ $notice->title }}</p>
                        <h4>Description</h4>
                        <p>{!! $notice->description !!}</p>
                        <h4>Order</h4>
                        <p>{{ $notice->order }}</p>
                        <h4>Status</h4>
                        <p>{{ $notice->status == 1 ? 'Active' : 'In Active' }}</p>
                        <h4>Created By User</h4>
                        <p>{{ $notice->creator->name }}</p>
                        <a href="{{ url('/notices/' . $notice->id . '/edit') . '?' . http_build_query($filters) }}" class="btn btn-primary">Edit</a>
                        <a href="{{ url('/notices?' . http_build_query($filters)) }}" class="btn btn-secondary">Back to
                            list</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection