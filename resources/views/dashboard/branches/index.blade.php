@extends('dashboard.base')

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <i class="fa fa-align-left"></i><strong>Branch List</strong>
                                </div>

                                <div class="col-md-6 text-right">
                                    <a href="{{ route('branches.create') }}" class="btn btn-primary">Add Branch</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="GET" action="{{ url()->current() }}">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="branch_name">Branch Name</label>
                                    <div class="col-md-9">
                                        <input class="form-control @error('branch_name') is-invalid @enderror"
                                            id="branch_name" type="text" name="name" placeholder="Enter Branch Name"
                                            length="160" autocomplete="branch" autofocus
                                            value="{{ $filters['name'] ?? '' }}">
                                        @error('branch_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="branch_code">Branch Code</label>
                                    <div class="col-md-9">
                                        <input class="form-control @error('branch_code') is-invalid @enderror"
                                            id="branch_code" type="text" name="code" placeholder="Enter Branch Name"
                                            length="160" autocomplete="branch" autofocus
                                            value="{{ $filters['code'] ?? '' }}">
                                        @error('branch_code')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="start_date">Start Date</label>
                                    <div class="col-md-9">
                                        <input class="form-control @error('start_date') is-invalid @enderror"
                                            id="start_date" type="date" name="date" placeholder="Enter Branch Name"
                                            length="160" autocomplete="branch" autofocus
                                            value="{{ $filters['date'] ?? '' }}">
                                        @error('start_date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="user" class="col-md-3 col-form-label">Creator</label>
                                    <div class="col-md-9">
                                        <select name="user" id="user" class="form-control">
                                            <option value="">All</option>
                                            @foreach ($creators as $creator)
                                                <option value="{{ $creator->id }}"
                                                    {{ ($filters['user'] ?? '') == $creator->id ? 'selected' : '' }}>
                                                    {{ $creator->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="status" class="col-md-3 col-form-label">Status</label>
                                    <div class="col-md-9">
                                        <select name="status" id="status" class="form-control">
                                            <option value="">All</option>
                                            <option value="1"
                                                {{ ($filters['status'] ?? '') === '1' ? 'selected' : '' }}>Active</option>
                                            <option value="0"
                                                {{ ($filters['status'] ?? '') === '0' ? 'selected' : '' }}>Inactive
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <a href="{{ route('branches.index') }}" class="btn btn-primary">Reset</a>
                            </form>
                        </div>
                        <div class="card-body">
                            @if (Session::has('message'))
                                <div class="row">
                                    <div class="col-12">
                                        <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                                    </div>
                                </div>
                            @endif

                            @if (Session::has('error'))
                                <div class="row">
                                    <div class="col-12">
                                        <div class="alert alert-danger" role="alert">{{ Session::get('error') }}</div>
                                    </div>
                                </div>
                            @endif
                            @include('dashboard.shared.pagination')
                            <table class="table table-responsive-sm table-bordered table-striped table-sm mt-2">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Branch Name</th>
                                        <th>Branch Code</th>
                                        <th>Start Date</th>
                                        <th>Order</th>
                                        <th>Created By</th>
                                        <th>View</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($branches as $branch)
                                        <tr class="{{ $branch->status == 0 ? 'table-danger' : '' }}">
                                            <td>{{ $loop->iteration + ($branches->currentPage() - 1) * $branches->perPage() }}
                                            </td>
                                            <td>{{ $branch->branch_name }}
                                            </td>
                                            <td>{{ $branch->branch_code }}</td>
                                            <td>{{ $branch->start_date }}</td>
                                            <td>{{ $branch->order }}</td>
                                            <td>{{ $branch->creator->name }}</td>
                                            <td>
                                                <a href="{{ url('/branches/' . $branch->id) . '?' . http_build_query(request()->query()) }}"
                                                    class="btn btn-primary">View</a>
                                            </td>
                                            <td>
                                                <a href="{{ url('/branches/' . $branch->id . '/edit') . '?' . http_build_query(request()->query()) }}"
                                                    class="btn btn-primary">Edit</a>
                                            </td>
                                            <td>
                                                <form action="{{ route('branches.destroy', ['branch' => $branch->id]) }}"
                                                    method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    @foreach (request()->query() as $key => $value)
                                                        <input type="hidden" name="{{ $key }}"
                                                            value="{{ $value }}">
                                                    @endforeach
                                                    <button class="btn btn-danger"
                                                        onclick="return confirm('Are you sure you want to delete this branch?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $branches->appends($filters)->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
