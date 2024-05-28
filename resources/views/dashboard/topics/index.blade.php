@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>Topic List
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
                            <a href="{{ route('topics.create') }}" class="btn btn-primary m-2">Add topic</a>
                        </div>
                        <br>
                        <table class="table table-responsive-sm table-striped">
                            <thead>
                                <tr>
                                    <th>Topic</th>
                                    <th>Subject</th>
                                    <th>Status</th>
                                    <th>Order</th>
                                    <th>Creator</th>
                                    <th>View</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($topics as $topic)
                                <tr>
                                    <td><strong>{{ $topic->name }}</strong></td>
                                    <td><strong>{{ $topic->subject->name }}</strong></td>
                                    <td><strong>{{ $topic->status == 1 ? 'Active' : 'Inactive'}}</strong></td>
                                    <td><strong>{{ $topic->order }}</strong></td>
                                    <td><strong>{{ $topic->creator->name }}</strong></td>
                                    <td>
                                        <a href="{{ url('/topics/' . $topic->id) }}" class="btn btn-primary">View</a>
                                    </td>
                                    <td>
                                        <a href="{{ url('/topics/' . $topic->id . '/edit') }}" class="btn btn-primary">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('topics.destroy', $topic->id ) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $topics->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')

@endsection