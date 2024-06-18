@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>courseSubject Subject List
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
                            <a href="{{ route('courseSubjects.create') }}" class="btn btn-primary m-2">Add courseSubject</a>
                        </div>
                        <br>
                        <table class="table table-responsive-sm table-striped">
                            <tbody>
                                @foreach($courseSubjects as $courseSubject)
                                <tr>
                                    <td>{{ $courseSubject->name }}</td>
                                    <td>{{ $courseSubject->order }}</td>
                                    <td>{{ $courseSubject->status == 1 ? 'active' : 'deactive' }}</td>
                                    <td>{{ $courseSubject->creator->name }}</td>
                                    <td>
                                        <a href="{{ url('/courseSubjects/' . $courseSubject->id) }}" class="btn btn-primary">View</a>
                                    </td>
                                    <td>
                                        <a href="{{ url('/courseSubjects/' . $courseSubject->id . '/edit') }}" class="btn btn-primary">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('courseSubjects.destroy', $courseSubject->id ) }}" method="POST">
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