@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i><strong>Course Subject List</strong>
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
                            <a href="{{ route('course-subjects.create') }}" class="btn btn-primary m-2">Add CourseSubject</a>
                        </div>
                        <br>
                        <table class="table table-responsive-sm table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Subject Name</th>
                                    <th>Course Name</th>
                                    <th>Status</th>
                                    <th>Created By</th>
                                    <th>View</th>
                                    <th>Edit</th>
                                    <th>Del</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($courseSubjects as $courseSubject)
                                <tr>
                                    <td>{{$courseSubjects->perpage()*($courseSubjects->currentpage()-1)+$loop->iteration }}</td>
                                    <td>{{ $courseSubject->subject->name }}</td>
                                    <td>{{ $courseSubject->course->name }}</td>
                                    <td>{{ $courseSubject->status ==1? 'active':'inactive' }}</td>
                                    <td>{{ $courseSubject->creator->name }}</td>
                                    <td>
                                        <a href="{{ url('/course-subjects/' . $courseSubject->id) }}" class="btn btn-primary">View</a>
                                    </td>
                                    <td>
                                        <a href="{{ url('/course-subjects/' . $courseSubject->id . '/edit') }}" class="btn btn-primary">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('course-subjects.destroy', $courseSubject->id ) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $courseSubjects->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')

@endsection