@extends('dashboard.base')

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Add Branch</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('branches.store') }}">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="branch_name">Branch Name</label>
                                    <div class="col-md-9">
                                        <input class="form-control @error('branch_name') is-invalid @enderror"
                                            id="branch_name" type="text" name="branch_name"
                                            placeholder="Enter Branch Name" length="160" autocomplete="branch" autofocus
                                            required value="{{ old('name') }}">
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
                                            required value="{{ old('name') }}">
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
                                            required value="{{ old('name') }}">
                                        @error('start_date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <button class="btn btn-success" type="submit">Add</button>
                                <a href="{{ route('branches.index') }}" class="btn btn-primary">Return</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
