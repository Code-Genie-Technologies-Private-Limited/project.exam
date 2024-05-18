@extends('dashboard.base')

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Add Topic</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('topics.store') }}">
                                @csrf
                                <div class="form-group row">
                                    <label>Name</label>
                                    <input class="form-control" type="text" placeholder="Name" name="name" required
                                        autofocus />
                                </div>
                                <div class="form-group row">
                                    <label>Subject Id</label>
                                    <input class="form-control" type="text" placeholder="Subject Id " name="subject_id"
                                        required />
                                </div>
                                <div class="form-group row">
                                    <label>Created By</label>
                                    <input class="form-control" type="text" placeholder="Created By" name="created_by"
                                        required />
                                </div>
                                <button class="btn btn-success" type="submit">Add</button>
                                <a href="{{ route('topics.index') }}" class="btn btn-primary">Return</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
@endsection
