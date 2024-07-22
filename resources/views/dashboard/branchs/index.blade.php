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
                                <i class="fa fa-align-left"></i><strong>branch List</strong>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="{{ route('branchs.create') }}" class="btn btn-primary">Add branch</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ url()->current() }}">
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="keyword">Keyword search </label>
                                <div class="col-md-9">
                                    <input class="form-control" id="name" type="text" name="keyword" placeholder="Enter keyword... " length="160" autocomplete="keyword" autofocus value="{{ $filters['keyword'] ?? '' }}">
                                    @error('name')
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
                                        <option value="{{ $creator->id }}" {{ ($filters['user'] ?? '') == $creator->id ? 'selected' : '' }}>
                                            {{ $creator->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="status" class="col-md-3 col-form-label">Status</label>
                                <div class="col-md-9">
                                    <select name="status" id="status" class="form-control">
                                        <option value="">All</option>
                                        <option value="1" {{ ($filters['status'] ?? '') == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ ($filters['status'] ?? '') == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Filter</button>
                            <a href="{{ route('branchs.index') }}" class="btn btn-primary">Reset</a>
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
                                    <th>Branch Code</th>
                                    <th>Branch Name</th>
                                    <th>Start Date</th>
                                   
                                    <th>Created By</th>
                                    <th>Status</th>
                                    <th>View</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($branchs as $branch)
                                <tr class="{{ $branch->status == 0 ? 'table-danger' : '' }}">
                                    <td>{{ $loop->iteration + ($branchs->currentPage() - 1) * $branchs->perPage() }}
                                    </td>
                                    <td>{{ $branch->branch_code }}
                                        <a href="{{ route('topics.index', ['branch' => $branch->id]) }}">
                                            <span class="badge badge-secondary">{{ $branch->topics_count }}</span>
                                        </a>
                                    </td>
                                    <td>{{ $branch->branch_name }}</td>
                                    <td >{{ $branch->start_date }}</td>
                                    
                                    <td>{{ $branch->creator->name }}</td>
                                    <td>
                                        <p>{{ $branch->status == 1 ? 'Active' : 'In Active' }}</p>
                                    </td>
                                    <td>
                                        <a href="{{ url('/branchs/' . $branch->id) . '?' . http_build_query(request()->query()) }}" class="btn btn-primary">View</a>
                                    </td>
                                    <td>
                                        <a href="{{ url('/branchs/' . $branch->id . '/edit') . '?' . http_build_query(request()->query()) }}" class="btn btn-primary">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('branchs.destroy', ['branch' => $branch->id]) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            @foreach (request()->query() as $key => $value)
                                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                            @endforeach
                                            <button class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this branch?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $branchs->appends($filters)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection