@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i><b>Subjects List</b>
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
                            <a href="{{ route('subjects.create') }}" class="btn btn-primary m-2">Add Subject</a>
                        </div>
                        <br>
                        <table class="table table-responsive-sm table-striped table-hover">
                            <thead>
                                <tr>
                                    <th><b>#</b></th>
                                    <th>Name</th>
                                    <th>Order</th>
                                    <th>Status</th>
                                    <th>Creator</th>
                                    <th>View</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($subjects as $key => $subject)
                                <tr>
                                    <td>{{ $subjects->perPage() * ($subjects->currentPage() - 1) + $loop->iteration }}</td>
                                    <td>{{ $subject->name }}</td>
                                    <td>{{ $subject->order }}</td>
                                    <td>{{ $subject->status==1?'Active':'Deactive'; }}</td>
                                    <td>{{ $subject->creator->name }}</td>
                                    <td>
                                        <a href="{{ url('/subjects/' . $subject->id) }}" class="btn btn-primary">View</a>
                                    </td>
                                    <td>
                                        <a href="{{ url('/subjects/' . $subject->id . '/edit') }}" class="btn btn-primary">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('subjects.destroy', $subject->id ) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $subjects->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')

@endsection