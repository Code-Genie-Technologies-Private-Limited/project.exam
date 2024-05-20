@extends('dashboard.base')

@section('content')
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Subject</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('subjects.update', $subject->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label>Name</label>
                                <input class="form-control" type="text" placeholder="Name" name="name" required autofocus value="{{ $subject->name }}" />
                            </div>
                            <div class="form-group row">
                                <label>Subject Id</label>
                                <input class="form-control" type="text" placeholder="Subject Id" name="subject_id" required value="{{ $subject->subject_id }}" />
                            </div>
                            <div class="form-group row">
                                <label>Order</label>
                                <input class="form-control" type="text" placeholder="Order" name="order" required value="{{ $subject->order }}" />
                            </div>
                            <div class="form-group row">
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
                                </div>
                                <div class="form-group row">
                                    <label>Created By</label>
                                    <input class="form-control" type="text" placeholder="Created By" name="created_by" required value="{{ $subject->created_by }}" />
                                </div>
                                <button class="btn btn-success" type="submit">Edit</button>
                                <a href="{{ route('subjects.index') }}" class="btn btn-primary">Return</a>
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