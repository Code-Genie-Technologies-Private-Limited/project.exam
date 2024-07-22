@extends('dashboard.base')

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Batch: {{ $batch->name }}</h4>
                        </div>
                        <div class="card-body">
                            <h4>Batch Name</h4>
                            <p>{{ $batch->name }}</p>
                            <h4>Batch Code</h4>
                            <p>{{ $batch->code }}</p>
                            <h4>Course</h4>
                            <p>{{ $batch->course->name }}</p>
                            <h4>Sub Course</h4>
                            <p>{{ $batch->subCourse->name }}</p>
                            <h4>Order</h4>
                            <p>{{ $batch->order }}</p>
                            <h4>Status</h4>
                            <p>{{ $batch->status == 1 ? 'Active' : 'In Active' }}</p>
                            <h4>Created By User</h4>
                            <p>{{ $batch->creator->name }}</p>
                            <a href="{{ url('/batches/' . $batch->id . '/edit') . '?' . http_build_query($filters) }}"
                                class="btn btn-primary">Edit</a>
                            <a href="{{ url('/batches?' . http_build_query($filters)) }}" class="btn btn-secondary">Back to
                                list</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
