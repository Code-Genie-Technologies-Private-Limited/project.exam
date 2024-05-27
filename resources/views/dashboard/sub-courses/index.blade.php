@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>Sub Course List
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
                        <div class="row">
                            <a href="{{ route('sub-courses.create') }}" class="btn btn-primary m-2">Add Sub Course</a>
                        </div>
                        <br>
                        <table class="table table-responsive-sm table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Course</th>
                                    <th>Order</th>
                                    <th>Created By User</th>
                                    <th>View</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($subCourses as $subCourse)
                                <tr>
                                    <td>{{ $loop->iteration + ($subCourses->currentPage() - 1) * $subCourses->perPage() }}</td>
                                    <td>{{ $subCourse->name }}<span class="badge {{ $subCourse->status == 1 ? 'badge-secondary': 'badge-warning' }}">{{ $subCourse->status == 1 ? "Active": "In Active" }}</span></td>
                                    <td>{{ $subCourse->course->name }}</td>
                                    <td>{{ $subCourse->order }}</td>
                                    <td>{{ $subCourse->creator->name }}</td>
                                    <td>
                                        <a href="{{ url('/sub-courses/' . $subCourse->id) }}" class="btn btn-primary">View</a>
                                    </td>
                                    <td>
                                        <a href="{{ url('/sub-courses/' . $subCourse->id . '/edit') }}" class="btn btn-primary">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('sub-courses.destroy', $subCourse->id ) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $subCourses->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')

@endsection