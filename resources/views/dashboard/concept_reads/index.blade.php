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
                                    <i class="fa fa-align-left"></i><strong>Concept Read List</strong>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="{{ route('concept-reads.create') }}" class="btn btn-primary">Add Concept Read</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="GET" action="{{ url()->current() }}">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="name">Concept Read</label>
                                    <div class="col-md-9">
                                        <input class="form-control" id="name" type="text" name="name"
                                            placeholder="Enter Concept Read name" length="160" autocomplete="Concept Read" autofocus
                                            value="{{ ($filters['name'] ?? '') }}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="difficulty_level">Difficulty Level</label>
                                    <div class="col-md-9">
                                    <select class="form-control" id="difficulty_level" name="difficulty">
                                        <option value="">Please select</option>
                                        <option value="easy" {{ ($filters['difficulty'] ?? '') == 'easy' ? 'selected' : '' }}>Easy</option>
                                        <option value="medium" {{ ($filters['difficulty'] ?? '') == 'medium' ? 'selected' : '' }}>Medium</option>
                                        <option value="hard" {{ ($filters['difficulty'] ?? '')  == 'hard' ? 'selected' : '' }}>Hard</option>
                                    </select>
                                    </div>
                                 </div> --}}
                                <div class="form-group row">
                                    <label for="course" class="col-md-3 col-form-label">Course</label>
                                    <div class="col-md-9">
                                        <select name="course" id="course" class="form-control">
                                            <option value="">All</option>
                                            @foreach ($courses as $course)
                                                <option value="{{ $course->id }}"
                                                    {{ ($filters['course'] ?? '') == $course->id ? 'selected' : '' }}>
                                                    {{ $course->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="subject" class="col-md-3 col-form-label">Subject</label>
                                    <div class="col-md-9">
                                        <select name="subject" id="subject" class="form-control">
                                            <option value="">All</option>
                                            @foreach ($subjects as $subject)
                                                <option value="{{ $subject->id }}"
                                                    {{ ($filters['subject'] ?? '') == $subject->id ? 'selected' : '' }}>
                                                    {{ $subject->name }}</option>
                                            @endforeach
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
                                <a href="{{ route('questions.index') }}" class="btn btn-primary">Reset</a>
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
                                        <th>Concept & Read</th>
                                        <th>Description</th>
                                        <th>Course</th>
                                        <th>Subject</th>
                                        <th>Order</th>
                                        <th>Created By</th>
                                        <th>View</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($conceptReads as $conceptRead)
                                        <tr class="{{ $conceptRead->status == 0 ? 'table-danger' : '' }}">
                                            <td>{{ $loop->iteration + ($conceptReads->currentPage() - 1) * $conceptReads->perPage() }}
                                            </td>
                                            <td>{{ $conceptRead->content_type_name }}<span
                                                    class="badge badge-secondary">{{ $conceptRead->conceptReads_count }}</span></td>
                                            <td>{{ $conceptRead->description }}</td>
                                            <td>{{ $conceptRead->course->name }}</td>
                                            <td>{{ $conceptRead->subject->name }}</td>
                                            <td>{{ $conceptRead->order }}</td>
                                            <td>{{ $conceptRead->creator->name }}</td>
                                            <td>
                                                <a href="{{ url('/concept-reads/' . $conceptRead->id) . '?' . http_build_query(request()->query()) }}"
                                                    class="btn btn-primary">View</a>
                                            </td>
                                            <td>
                                                <a href="{{ url('/concept-reads/' . $conceptRead->id . '/edit') . '?' . http_build_query(request()->query()) }}"
                                                    class="btn btn-primary">Edit</a>
                                            </td>
                                            <td>
                                                <form action="{{ route('concept-reads.destroy', ['concept_read' => $conceptRead->id]) }}"
                                                    method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    @foreach (request()->query() as $key => $value)
                                                        <input type="hidden" name="{{ $key }}"
                                                            value="{{ $value }}">
                                                    @endforeach
                                                    <button class="btn btn-danger"
                                                        onclick="return confirm('Are you sure you want to delete this concept & read?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $conceptReads->appends($filters)->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
