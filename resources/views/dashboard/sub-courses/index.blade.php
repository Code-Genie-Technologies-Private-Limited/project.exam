@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i><b>Sub Course List</b>
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
                        <table class="table table-responsive-sm table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Sub Course</th>
                                    <th>Course</th>
                                    <th>Status</th>
                                    <th>Order</th>
                                    <th>Creator</th>
                                    <th>View</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($subCourses as $SubCourse)
                                <tr>
                                    <td><b>{{$subCourses->perPage()* ($subCourses->currentPage()-1)+$loop->iteration}}</b></td>
                                    <td>{{ $SubCourse->name }}</td>
                                    <td>{{ $SubCourse->course->name }}</td>
                                    <td>{{ $SubCourse->status == 1 ? 'Active' : 'Inactive'}}</td>
                                    <td>{{ $SubCourse->order }}</td>
                                    <td>{{ $SubCourse->creator->name }}</td>
                                    <td>
                                        <a href="{{ url('/sub-courses/' . $SubCourse->id) }}" class="btn btn-primary">View</a>
                                    </td>
                                    <td>
                                        <a href="{{ url('/sub-courses/' . $SubCourse->id . '/edit') }}" class="btn btn-primary">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('sub-courses.destroy', $SubCourse->id ) }}" method="POST">
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