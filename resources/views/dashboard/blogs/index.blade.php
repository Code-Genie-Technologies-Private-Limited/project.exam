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
                                <i class="fa fa-align-left"></i><strong>Blog List</strong>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="{{ route('blogs.create') }}" class="btn btn-primary">Add Blog</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ url()->current() }}">
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="title">Keyword Search</label>
                                <div class="col-md-9">
                                    <input class="form-control" id="title" type="text" name="keyword" placeholder="Enter blog title" length="160" autocomplete="blog" autofocus value="{{ $filters['keyword'] ?? '' }}">
                                    @error('keyword')
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
                                        <option value="{{ $creator->id }}" {{ ($filters['user'] ?? '') == $creator->id ? 'selected' : '' }}>{{ $creator->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="status" class="col-md-3 col-form-label">Status</label>
                                <div class="col-md-9">
                                    <select name="status" id="status" class="form-control">
                                        <option value="">All</option>
                                        <option value="1" {{ ($filters['status'] ?? '') == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ ($filters['status'] ?? '') == '0' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Filter</button>
                            <a href="{{ route('blogs.index') }}" class="btn btn-primary">Reset</a>
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
                        <div class="row mb-3">
                            <div class="col-6">
                                <form method="GET" action="{{ url()->current() }}">
                                    <select id="perPage" name="per_page" class="form-control w-auto d-inline" onchange="this.form.submit()">
                                        <option value="5" {{ ($filters['per_page'] ?? 10) == 5 ? 'selected' : '' }}>5</option>
                                        <option value="10" {{ ($filters['per_page'] ?? 10) == 10 ? 'selected' : '' }}>10</option>
                                        <option value="25" {{ ($filters['per_page'] ?? 10) == 25 ? 'selected' : '' }}>25</option>
                                        <option value="50" {{ ($filters['per_page'] ?? 10) == 50 ? 'selected' : '' }}>50</option>
                                        <option value="100" {{ ($filters['per_page'] ?? 10) == 100 ? 'selected' : '' }}>100</option>
                                    </select>
                                    @foreach(request()->except('per_page') as $key => $value)
                                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                    @endforeach
                                </form>
                            </div>
                        </div>
                        <table class="table table-responsive-sm table-bordered table-striped table-sm mt-2">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Content</th>
                                    <th>Description</th>
                                    <th>Order</th>
                                    <th>Created By</th>
                                    <th>View</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($blogs as $blog)
                                <tr class="{{ $blog->status == 0 ? 'table-danger' : '' }}">
                                    <td>{{ $loop->iteration + ($blogs->currentPage() - 1) * $blogs->perPage() }}</td>
                                    <td>{{ $blog->title }}
                                        <a href="{{ route('topics.index', ['blog' => $blog->id]) }}">
                                            <span class="badge badge-secondary">{{ $blog->topics_count }}</span>
                                        </a>
                                    </td>
                                    <td class="description">{!! $blog->content !!}</td>
                                    <td class="description">{!! $blog->description !!}</td>
                                    <td>{{ $blog->order }}</td>
                                    <td>{{ $blog->creator->name }}</td>
                                    <td>
                                        <a href="{{ url('/blogs/' . $blog->id) . '?' . http_build_query(request()->query()) }}" class="btn btn-primary">View</a>
                                    </td>
                                    <td>
                                        <a href="{{ url('/blogs/' . $blog->id . '/edit') . '?' . http_build_query(request()->query()) }}" class="btn btn-primary">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('blogs.destroy', ['blog' => $blog->id]) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            @foreach(request()->query() as $key => $value)
                                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                            @endforeach
                                            <button class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this blog?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $blogs->appends($filters)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')
<script>
    document.getElementById('perPage').addEventListener('change', function() {
        this.form.submit();
    });
</script>
@endsection