@extends('dashboard.base')

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>concept & read: {{ $conceptRead->name }}</h4>
                        </div>
                        <div class="card-body">
                            <h4>Concept & Read</h4>
                            <p>{{ $conceptRead->content_type_name }}</p>
                            <h4>Description</h4>
                            <p>{{ $conceptRead->description }}</p>
                            <h4>Course</h4>
                            <p>{{ $conceptRead->course->name }}</p>
                            <h4>Subject</h4>
                            <p>{{ $conceptRead->subject->name }}</p>
                            <h4>Order</h4>
                            <p>{{ $conceptRead->order }}</p>
                            <h4>Status</h4>
                            <p>{{ $conceptRead->status == 1 ? 'Active' : 'Inactive' }}</p>
                            <h4>Created By User</h4>
                            <p>{{ $conceptRead->creator->name }}</p>
                            <a href="{{ url('/concept-reads/' . $conceptRead->id . '/edit') . '?' . http_build_query($filters) }}"
                                class="btn btn-primary">Edit</a>
                            <a href="{{ url('/concept-reads?' . http_build_query($filters)) }}" class="btn btn-secondary">Back to
                                list</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
