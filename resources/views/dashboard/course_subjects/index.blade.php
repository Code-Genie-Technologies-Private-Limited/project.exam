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
                                <i class="fa fa-align-left"></i><strong>Course Subject List</strong>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="{{ route('course-subjects.create') }}" class="btn btn-primary">Add Course Subject</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ url()->current() }}">
                            <div class="form-group row">
                                <label for="course" class="col-md-3 col-form-label">Course</label>
                                <div class="col-md-9">
                                    <select name="course" id="course" class="form-control">
                                        <option value="">All</option>
                                        @foreach($courses as $course)
                                        <option value="{{ $course->id }}" {{ ($filters['course'] ?? '') == $course->id ? 'selected' : '' }}>{{ $course->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="subject" class="col-md-3 col-form-label">Subject</label>
                                <div class="col-md-9">
                                    <select name="subject" id="subject" class="form-control">
                                        <option value="">All</option>
                                        @foreach($subjects as $subject)
                                        <option value="{{ $subject->id }}" {{ ($filters['subject'] ?? '') == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                                        @endforeach
                                    </select>
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
                            <button type="submit" class="btn btn-primary">Filter</button>
                            <a href="{{ route('course-subjects.index') }}" class="btn btn-primary">Reset</a>
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
                                    <th>Subject Name</th>
                                    <th>Course Name</th>
                                    <th>Creator</th>
                                    <th>View</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($courseSubjects as $courseSubject)
                                <tr>
                                    <td>{{ $loop->iteration + ($courseSubjects->currentPage() - 1) * $courseSubjects->perPage() }}</td>
                                    <td>{{ $courseSubject->subject->name }}</td>

                                    <td>{{ $courseSubject->course->name }}</td>

                                    <td>{{ $courseSubject->creator->name }}</td>

                                    <td>
                                        <a href="{{ url('/course-subjects/' . $courseSubject->id) . '?' . http_build_query(request()->query()) }}" class="btn btn-primary">View</a>
                                    </td>
                                    <td>
                                        <a href="{{ url('/course-subjects/' . $courseSubject->id . '/edit') . '?' . http_build_query(request()->query()) }}" class="btn btn-primary">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('course-subjects.destroy', ['course_subject' => $courseSubject->id]) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            @foreach(request()->query() as $key => $value)
                                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                            @endforeach
                                            <button class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this ?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $courseSubjects->appends($filters)->links() }}
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