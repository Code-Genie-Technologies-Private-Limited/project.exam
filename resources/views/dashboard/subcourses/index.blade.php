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
                        <div class="row">
                            <a href="{{ route('sub-courses.create') }}" class="btn btn-primary m-2">Add Sub Course</a>
                        </div>
                        <br>
                        <table class="table table-responsive-sm table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Course Name</th>
                                    <th>Order</th>
                                    <th>Status</th>
                                    <th>Creator</th>
                                    <th>View</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($subCourses as $subcourse)
                                <tr>
                                    <td>{{ $subCourses->perPage()*($subCourses->currentPage()-1)+$loop->iteration }}</td>
                                    <td>{{ $subcourse->name }}</td>
                                    <td>{{ $subcourse->course->name }}</td>
                                    <td>{{ $subcourse->order }}</td>
                                    <td>{{ $subcourse->status == 1 ? 'Active': 'Inactive' }}</td>
                                    <td>{{ $subcourse->creator->name }}</td>
                                    <td>
                                        <a href="{{ url('/sub-courses/' . $subcourse->id) }}" class="btn btn-primary">View</a>
                                    </td>
                                    <td>
                                        <a href="{{ url('/sub-courses/' . $subcourse->id . '/edit') }}" class="btn btn-primary">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('sub-courses.destroy', $subcourse->id ) }}" method="POST">
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