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
                                <i class="fa fa-align-left"></i><strong>Subject List</strong>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('subjects.create') }}" class="btn btn-primary fa fa-align-right">Add Subject</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ url()->current() }}">
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="name">Subject Name</label>
                                <div class="col-md-9">
                                    <input class="form-control" id="name" type="text" name="name" placeholder="Enter subject name" length="160" autocomplete="subject" autofocus value="{{ $filters['name'] ?? '' }}">
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
                                        @foreach($creators as $creator)
                                        <option value="{{ $creator->id }}" {{ $filters['creator'] ?? '' == $creator->id ? 'selected' : '' }}>{{ $creator->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="status" class="col-md-3 col-form-label">Status</label>
                                <div class="col-md-9"><select name="status" id="status" class="form-control">
                                        <option value="">All</option>
                                        <option value="1" {{ ($filters['status'] ?? '') === '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ ($filters['status'] ?? '') === '0' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Filter</button>
                            <a href="{{ route('subjects.index') }}" class="btn btn-primary">Reset</a>
                        </form>
                    </div>
                    <div class="card-body">
                        @if(Session::has('message'))
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                            </div>
                        </div>
                        @endif

                        @if(Session::has('error'))
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-danger" role="alert">{{ Session::get('error') }}</div>
                            </div>
                        </div>
                        @endif
                        <table class="table table-responsive-sm table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Order</th>
                                    <th>Created By</th>
                                    <th>View</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($subjects as $subject)
                                <tr>
                                    <td>{{ $loop->iteration + ($subjects->currentPage() - 1) * $subjects->perPage() }}</td>
                                    <td>{{ $subject->name }}<span class="badge {{ $subject->status == 1 ? 'badge-secondary': 'badge-warning' }}">{{ $subject->status == 1 ? "Active": "In Active" }}</span></td>
                                    <td>{{ $subject->order }}</td>
                                    <td>{{ $subject->creator->name }}</td>
                                    <td>
                                        <a href="{{ url('/subjects/' . $subject->id) . '?' . http_build_query(request()->query()) }}" class="btn btn-primary">View</a>
                                    </td>
                                    <td>
                                        <a href="{{ url('/subjects/' . $subject->id . '/edit') . '?' . http_build_query(request()->query()) }}" class="btn btn-primary">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('subjects.destroy', ['subject' => $subject->id, 'page' => request()->input('page', 1)]) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $subjects->appends($filters)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')

@endsection