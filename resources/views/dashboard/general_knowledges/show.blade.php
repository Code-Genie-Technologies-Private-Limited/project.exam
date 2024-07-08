@extends('dashboard.base')

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>General & Knowledge: {{ $generalKnowledge->name }}</h4>
                        </div>
                        <div class="card-body">
                            <h4>General & Knowledge</h4>
                            <p>{{ $generalKnowledge->type }}</p>
                            <h4>Course</h4>
                            <p>{{ $generalKnowledge->course->name }}</p>
                            <h4>Description</h4>
                            <p>{{ $generalKnowledge->description }}</p>
                            <h4>Order</h4>
                            <p>{{ $generalKnowledge->order }}</p>
                            <h4>Status</h4>
                            <p>{{ $generalKnowledge->status == 1 ? 'Active' : 'In Active' }}</p>
                            <h4>Created By User</h4>
                            <p>{{ $generalKnowledge->creator->name }}</p>
                            <a href="{{ url('/general-knowledges/' . $generalKnowledge->id . '/edit') . '?' . http_build_query($filters) }}"
                                class="btn btn-primary">Edit</a>
                            <a href="{{ url('/general-knowledges?' . http_build_query($filters)) }}" class="btn btn-secondary">Back to
                                list</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
