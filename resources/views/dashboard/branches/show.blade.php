@extends('dashboard.base')

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Branch: {{ $branch->name }}</h4>
                        </div>
                        <div class="card-body">
                            <h4>Branch Name</h4>
                            <p>{{ $branch->branch_name }}</p>
                            <h4>Branch code</h4>
                            <p>{{ $branch->branch_code }}</p>
                            <h4>Start Date</h4>
                            <p>{{ $branch->start_date }}</p>
                            <h4>Order</h4>
                            <p>{{ $branch->order }}</p>
                            <h4>Status</h4>
                            <p>{{ $branch->status == 1 ? 'Active' : 'In Active' }}</p>
                            <h4>Created By User</h4>
                            <p>{{ $branch->creator->name }}</p>
                            <a href="{{ url('/branches/' . $branch->id . '/edit') . '?' . http_build_query($filters) }}"
                                class="btn btn-primary">Edit</a>
                            <a href="{{ url('/branches?' . http_build_query($filters)) }}" class="btn btn-secondary">Back to
                                list</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
