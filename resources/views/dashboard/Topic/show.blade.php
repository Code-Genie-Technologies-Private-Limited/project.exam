@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4>topic: {{ $topic->name }}</h4>
                    </div>
                    <div class="card-body">
                        <h4>Name</h4>
                        <p>{{ $topic->name }}</p>
                        <h4>topic</h4>
                        <p>{{ $topic->mobile_number }}</p>
                        <h4>Content</h4>
                        <p>{{ $topic->roll_number }}</p>
                        <a href="{{ route('topics.index') }}" class="btn btn-primary">Return</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')

@endsection