@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i><b>
                            <h4>Class List</h4>
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
                            <a href="{{ route('klasses.create') }}" class="btn btn-primary m-2">Add Class</a>
                        </div>
                        <br>
                        <table class="table table-responsive-sm table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
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
                                @foreach($klasses as $klass)
                                <tr>
                                    <td>{{ $klasses->perPage()*($klasses->currentPage()-1)+$loop->iteration }}</td>
                                    <td>{{ $klass->name }}</td>
                                    <td>{{ $klass->order }}</td>
                                    <td>{{ $klass->status == 1 ? 'Active': 'Inactive' }}</td>
                                    <td>{{ $klass->creator->name }}</td>
                                    <td>
                                        <a href="{{ url('/klasses/' . $klass->id) }}" class="btn btn-primary">View</a>
                                    </td>
                                    <td>
                                        <a href="{{ url('/klasses/' . $klass->id . '/edit') }}" class="btn btn-primary">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('klasses.destroy', $klass->id ) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $klasses->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')

@endsection