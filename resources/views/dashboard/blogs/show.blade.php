@extends('dashboard.base')

@section('content')
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4>blog: {{ $blog->name }}</h4>
                    </div>
                    <div class="card-body">
                        <h4>Name</h4>
                        <p>{{ $blog->title }}</p>
                        <h4>Content</h4>
                        <p>{{ $blog->content }}</p>
                        <h4>Description</h4>
                        <p>{!! $blog->description !!}</p>
                        <h4>Order</h4>
                        <p>{{ $blog->order }}</p>
                        <h4>Status</h4>
                        <p>{{ $blog->status == 1 ? 'Active' : 'In Active' }}</p>
                        <h4>Created By User</h4>
                        <p>{{ $blog->creator->name }}</p>
                        <a href="{{ url('/blogs/' . $blog->id . '/edit') . '?' . http_build_query($filters) }}" class="btn btn-primary">Edit</a>
                        <a href="{{ url('/blogs?' . http_build_query($filters)) }}" class="btn btn-secondary">Back to
                            list</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection