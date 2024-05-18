@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit subject</h4>
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
                                <label class="col-md-3 col-form-label">Status</label>
                                <div class="col-md-9 col-form-label">
                                    <div class="form-check">
                                        <input class="form-check-input" id="radio1" type="radio" value="1" name="status" {{$subject->status==1?'checked':''}}>
                                        <label class="form-check-label" for="radio1">Active</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" id="radio2" type="radio" value="0" name="status" {{$subject->status==0?'checked':''}}>
                                        <label class="form-check-label" for="radio2">De-active</label>
                                    </div>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label>Order</label>
                                <input class="form-control" type="text" placeholder="Order" name="order" required autofocus value="{{ $subject->order }}" />
                            </div>

                            <button class="btn btn-success" type="submit">Update</button>
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