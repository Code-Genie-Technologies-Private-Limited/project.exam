@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Student</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('phones.update', $phone->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label>Name</label>
                                <input class="form-control" type="text" placeholder="Name" name="name" required autofocus value="{{ $phone->name }}" />
                            </div>
                            <div class="form-group row">
                                <label>address</label>
                                <input class="form-control" type="text" placeholder="address" name="address" required value="{{ $phone->order }}" />
                            </div>
                            <!-- <div class="form-group row">
                                <label>status</label>
                                <input class="form-control" type="text" placeholder="Roll Number" name="roll_number" required value="{{ $phone->status }}" />
                            </div> -->
                            <!-- <div class="form-group row">
                                <label class="col-md-3 col-form-label">Status</label>
                                <div class="col-md-9 col-form-label">
                                    <div class="form-check">
                                        <input class="form-check-input" id="active" type="radio" value="1" name="status" {{$phone->status==1 ? 'checked' : ''}}>
                                        <label class="form-check-label" for="active">Active</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" id="deactive" type="radio" value="0" name="status" {{$phone->status==0 ? 'checked' : ''}}>
                                        <label class="form-check-label" for="deactive">Deactive</label>
                                    </div>

                                </div>
                            </div> -->
                            <button class="btn btn-success" type="submit">Update</button>
                            <a href="{{ route('phones.index') }}" class="btn btn-primary">Return</a>
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