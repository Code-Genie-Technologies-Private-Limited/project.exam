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
                                <input class="form-control" type="text" placeholder="Name" name="name" required autofocus />
                            </div>
                            <div class="form-group row">
                                <label>Subject Id</label>
                                <input class="form-control" type="text" placeholder="Subject Id " name="subject_id" required />
                            </div>
                            <div class="form-group row">
                                <label>order</label>
                                <input class="form-control" type="text" placeholder="order" name="order" required />
                            </div>
                            <!-- <div class="form-group row">
                                <label class="col-md-3 col-form-label">status</label>
                                <div class="col-md-9 col-form-label">
                                    <div class="form-check">
                                        <input class="form-check-input" id="Active" type="radio" value="1" name="status">
                                        <label class="form-check-label" for="Active">Active</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" id="Inactive" type="radio" value="0" name="status">
                                        <label class="form-check-label" for="Inactive">Inactive</label>
                                    </div>
                                </div> -->
                                <div class="form-group row">
                                    <label>created_by</label>
                                    <input class="form-control" type="text" placeholder="created_by" name="created_by" required />
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