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
                            <a href="{{ route('subCourses.create') }}" class="btn btn-primary m-2">Add subCourse</a>
                        </div>
                        <br>
                        <table class="table table-responsive-sm table-striped">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Name</th>
                                    <th>Order</th>
                                    <th>Created by</th>
                                    <th>Course</th>
                                    <th>View</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($subCourses as $i=> $subCourse)
                                
                                <tr>
                                    <td><b>{{$i + 1}}</b></td>
                                    <td><strong>{{ $subCourse->name }}</strong></td>
                                    <td><strong>{{ $subCourse->order }}</strong></td>
                                    <td><strong>{{ $subCourse->creator->name }}</strong></td>
                                    <td> <b>{{$subCourse->subCourses->name}}</b></td>
                                    <td>{{ $subCourse->status == 1 ? 'Active' : 'Deactive' }}</td>
                                    <td>
                                        <a href="{{ url('/subCourses/' . $subCourse->id) }}" class="btn btn-primary">View</a>
                                        <a href="{{ url('/subCourses/' . $subCourse->id . '/edit') }}" class="btn btn-primary">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('subCourses.destroy', $subCourse->id ) }}" method="POST">
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