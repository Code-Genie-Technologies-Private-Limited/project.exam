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
                        @if(Session::has('topic_message'))
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-success" role="alert">{{ Session::get('topic_message') }}</div>
                            </div>
                        </div>
                        @endif
                        <div class="row">
                            <a href="{{ route('topics.create') }}" class="btn btn-primary m-2">Add Topic</a>
                        </div>
                        <br>
                        <table class="table table-responsive-sm table-striped">
                            <thead>
                                <tr>
                                    <th>Topic Name</th>
                                    <th>Subject Name</th>
                                    <th>Order</th>
                                    <th>Status</th>
                                    <th>Created By</th>
                                    <th colspan="3" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($topics as $topic_details)
                                <tr>
                                    <td><strong>{{ $topic_details->name }}</strong></td>
                                    <td><strong>{{ $topic_details->subject->name }}</strong></td>
                                    <td><strong>{{ $topic_details->order != '' ? $topic_details->order : 'N/A' }}</strong></td>
                                    <td>
                                        <strong>
                                            @if($topic_details->status == 1)
                                            Active
                                            @else
                                            InActive
                                            @endif
                                        </strong>
                                    </td>
                                    <td><strong>{{ $topic_details->user->name }}</strong></td>
                                    <td>
                                        <a href="{{ url('/topics/' . $topic_details->id) }}" class="btn btn-primary">View</a>
                                    </td>
                                    <td>
                                        <a href="{{ url('/topics/' . $topic_details->id . '/edit') }}" class="btn btn-primary">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('topics.destroy', $topic_details->id ) }}" method="POST">
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