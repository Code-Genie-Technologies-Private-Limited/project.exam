@extends('dashboard.base')

@section('content')
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i><strong>Question List</strong>
                    </div>
                    <div class="card-body">
                        @if (Session::has('message'))
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                            </div>
                        </div>
                        @endif
                        @if (Session::has('error'))
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-danger" role="alert">{{ Session::get('error') }}</div>
                            </div>
                        </div>
                        @endif
                        <div class="row">
                            <a href="{{ route('questions.create') }}" class="btn btn-primary m-2">Add Question</a>
                        </div>
                        <br>
                        <table class="table table-responsive-sm table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Subject Name</th>
                                    <th>Topic Name</th>
                                    <th>Difficulty Level</th>
                                    <th>Keyword</th>
                                    <th>Options</th>
                                    <th>Answer</th>
                                    <th>status</th>
                                    <th>order</th>
                                    <th>Creator</th>
                                    <th>View</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($questions as $question)
                                <tr>
                                    <td>{{ $questions->perPage()*($questions->currentPage()-1)+$loop->iteration }}</td>
                                    <td>{{ $question->Subject->name }}</td>
                                    <td>{{ $question->Topic->name }}</td>
                                    <td>{{ $question->difficulty_level }}</td>
                                    <td>{{ $question->keyword }}</td>
                                    <td>{{ $question->options }}</td>
                                    <td>{{ $question->answer }}</td>
                                    <td>{{ $question->status }}</td>
                                    <td>{{ $question->order }}</td>
                                    <td>{{ $question->creator->name }}</td>
                                    <td>
                                        <a href="{{ url('/questions/' . $question->id) }}" class="btn btn-primary">View</a>
                                    </td>
                                    <td>
                                        <a href="{{ url('/questions/' . $question->id . '/edit') }}" class="btn btn-primary">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('questions.destroy', $question->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $questions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
@endsection