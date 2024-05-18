@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>Subject List
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
                            <a href="{{ route('subjects.create') }}" class="btn btn-primary m-2">Add Subject</a>
                        </div>
                        <br>
                        <table class="table table-responsive-sm table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Order</th>
                                    <th>Status</th>
                                    <th>Created By</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($subjects as $subject)
                                <tr>
                                    <td>{{ $subject->name }}</td>
                                    <td>{{ $subject->order }}</td>
                                    <td>{{ $subject->status }}</td>
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