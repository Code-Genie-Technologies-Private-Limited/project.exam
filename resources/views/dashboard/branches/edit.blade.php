@extends('dashboard.base')

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Branch</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST"
                                action="{{ url('/branches/' . $branch->id) . '?' . http_build_query($filters) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="branch_name">Branch Name</label>
                                    <div class="col-md-9">
                                        <input class="form-control @error('branch_name') is-invalid @enderror"
                                            id="branch_name" type="text" name="branch_name"
                                            placeholder="Enter Branch Name" length="160" autocomplete="branch" autofocus
                                            required value="{{ old('branch_name') ?? $branch->branch_name }}">
                                        @error('branch_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="branch_code">Branch Code</label>
                                    <div class="col-md-9">
                                        <input class="form-control @error('branch_code') is-invalid @enderror"
                                            id="branch_code" type="text" name="branch_code"
                                            placeholder="Enter Branch Name" length="160" autocomplete="branch" autofocus
                                            required value="{{ old('branch_name') ?? $branch->branch_code }}">
                                        @error('branch_code')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="start_date">Start Date</label>
                                    <div class="col-md-9">
                                        <input class="form-control @error('start_date') is-invalid @enderror"
                                            id="start_date" type="date" name="start_date"
                                            placeholder="Enter Branch Name" length="160" autocomplete="branch" autofocus
                                            required value="{{ old('branch_name') ?? $branch->start_date }}">
                                        @error('start_date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="order">Priority Order</label>
                                    <div class="col-md-9">
                                        <input class="form-control" id="order" type="number" name="order"
                                            placeholder="Enter Priority Order" step="0.01"
                                            value="{{ old('order', number_format($branch->order, 2)) }}">
                                        @error('order')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Status</label>
                                    <div class="col-md-9 col-form-label">
                                        <div class="form-check form-check-inline mr-1">
                                            <input class="form-check-input" id="active" type="radio" value="1"
                                                name="status" @checked(old('status', $branch->status) == 1)>
                                            <label class="form-check-label" for="active">Active</label>
                                        </div>
                                        <div class="form-check form-check-inline mr-1">
                                            <input class="form-check-input" id="in-active" type="radio" value="0"
                                                name="status" @checked(old('status', $branch->status) == 0)>
                                            <label class="form-check-label" for="in-active">In Active</label>
                                        </div>
                                        @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <button class="btn btn-success" type="submit">Update</button>
                                <a href="{{ url('/branches?' . http_build_query($filters)) }}"
                                    class="btn btn-secondary">Back to list</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
