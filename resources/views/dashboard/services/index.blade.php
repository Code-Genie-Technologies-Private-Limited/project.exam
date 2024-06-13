@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i><b>
                            <h4>Service List</h4>
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
                            <a href="{{ route('services.create') }}" class="btn btn-primary m-2">Add Service</a>
                        </div>
                        <br>
                        <table class="table table-responsive-sm table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Order</th>
                                    <th>Status</th>
                                    <th>Creator</th>
                                    <th>View</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($services as $service)
                                <tr>
                                    <td>{{ $services->perPage()*($services->currentPage()-1)+$loop->iteration }}</td>
                                    <td>{{ $service->name }}</td>
                                    <td>{{ $service->price }}</td>
                                    <td>{{ $service->order }}</td>
                                    <td>{{ $service->status == 1 ? 'Active': 'Inactive' }}</td>
                                    <td>{{ $service->creator->name }}</td>
                                    <td>
                                        <a href="{{ url('/services/' . $service->id) }}" class="btn btn-primary">View</a>
                                    </td>
                                    <td>
                                        <a href="{{ url('/services/' . $service->id . '/edit') }}" class="btn btn-success">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('services.destroy', $service->id ) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $services->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')

@endsection