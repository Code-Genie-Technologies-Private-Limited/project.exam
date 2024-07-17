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
                                    <i class="fa fa-align-left"></i><strong>Notice List</strong>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="{{ route('notices.create') }}" class="btn btn-primary">Add Notice</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="GET" action="{{ url()->current() }}">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="title">Notice Name</label>
                                    <div class="col-md-9">
                                        <input class="form-control" id="title" type="text" name="title"
                                            placeholder="Enter notice title" length="160" autocomplete="notice" autofocus
                                            value="{{ $filters['title'] ?? '' }}">
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="type">Type</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="type" name="type">
                                            <option value="">Please select</option>
                                            <option value="mobile application"
                                                {{ ($filters['type'] ?? '') == 'mobile application' ? 'selected' : '' }}>
                                                mobile application</option>
                                            <option value="web application"
                                                {{ ($filters['type'] ?? '') == 'web application' ? 'selected' : '' }}>web
                                                application</option>
                                        </select>
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
                                <a href="{{ route('notices.index') }}" class="btn btn-primary">Reset</a>
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
                                        <th>Title</th>
                                        <th>Type</th>
                                        <th>Description</th>
                                        <th>Order</th>
                                        <th>Created By</th>
                                        <th>View</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($notices as $notice)
                                        <tr class="{{ $notice->status == 0 ? 'table-danger' : '' }}">
                                            <td>{{ $loop->iteration + ($notices->currentPage() - 1) * $notices->perPage() }}
                                            </td>
                                            <td>{{ $notice->title }}
                                                <a href="{{ route('topics.index', ['notice' => $notice->id]) }}">
                                                    <span class="badge badge-secondary">{{ $notice->topics_count }}</span>
                                                </a>
                                            </td>
                                            <td>{{ $notice->type }}</td>
                                            <td class="description">{!! $notice->description !!}</td>
                                            <td>{{ $notice->order }}</td>
                                            <td>{{ $notice->creator->name }}</td>
                                            {{-- <td>
                                                <a href="{{ route('notices.downloadPDF', ['id' => $notice->id]) }}"
                                                    class="btn btn-info">Download PDF</a>
                                                <a href="{{ route('notices.downloadHTML', ['id' => $notice->id]) }}"
                                                    class="btn btn-info">Download HTML</a>
                                            </td> --}}
                                            <td>
                                                <a href="{{ url('/notices/' . $notice->id) . '?' . http_build_query(request()->query()) }}"
                                                    class="btn btn-primary">View</a>
                                            </td>
                                            <td>
                                                <a href="{{ url('/notices/' . $notice->id . '/edit') . '?' . http_build_query(request()->query()) }}"
                                                    class="btn btn-primary">Edit</a>
                                            </td>
                                            <td>
                                                <form action="{{ route('notices.destroy', ['notice' => $notice->id]) }}"
                                                    method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    @foreach (request()->query() as $key => $value)
                                                        <input type="hidden" name="{{ $key }}"
                                                            value="{{ $value }}">
                                                    @endforeach
                                                    <button class="btn btn-danger"
                                                        onclick="return confirm('Are you sure you want to delete this notice?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $notices->appends($filters)->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
