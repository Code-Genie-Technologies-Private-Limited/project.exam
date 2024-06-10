@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i><b>
                            <h4>School List</h4>
                        </b>
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
                                <div class="alert alert-success" role="alert">{{ Session::get('error') }}</div>
                            </div>
                        </div>
                        @endif
                        <div class="row">
                            <a href="{{ route('schools.create') }}" class="btn btn-primary m-2">Add School</a>
                        </div>
                        <br>
                        <table class="table table-responsive-sm table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Contact Person</th>
                                    <th>Contact Number</th>
                                    <th>Order</th>
                                    <th>Status</th>
                                    <th>Creator</th>
                                    <th>View</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($schools as $school)
                                <tr>
                                    <td>{{ $schools->perPage()*($schools->currentPage()-1)+$loop->iteration }}</td>
                                    <td>{{ $school->name }}</td>
                                    <td>{{ $school->address == '' ? 'NA' : $school->address }}</td>
                                    <td>{{ $school->contact_person == '' ? 'NA' :$school->contact_person }}</td>
                                    <td>{{ $school->contact_number == '' ? 'NA' : $school->contact_number}}</td>
                                    <td>{{ $school->order }}</td>
                                    <td>{{ $school->status == 1 ? 'Active': 'Inactive' }}</td>
                                    <td>{{ $school->creator->name }}</td>
                                    <td>
                                        <a href="{{ url('/schools/' . $school->id) }}" class="btn btn-primary">View</a>
                                    </td>
                                    <td>
                                        <a href="{{ url('/schools/' . $school->id . '/edit') }}" class="btn btn-primary">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('schools.destroy', $school->id ) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $schools->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')

@endsection