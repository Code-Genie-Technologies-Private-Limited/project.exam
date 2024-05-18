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
                                <label class="col-md-3 col-form-label" for="name">Subject Name</label>
                                <div class="col-md-9">
                                    <input class="form-control" id="name" type="text" name="name" placeholder="Enter Subject Name" autocomplete="subject" autofocus required value="{{old('name')}}">
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label>Order</label>
                                <input class="form-control" type="text" placeholder="Mobile Number" name="order" value="{{ $subject->order }}" />
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Status</label>
                                <div class="col-md-9 col-form-label">
                                    <div class="form-check form-check-inline mr-1">
                                        <input class="form-check-input" id="active" type="radio" value="1" name="status" {{ $subject->status == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="active">Active</label>
                                    </div>
                                    <div class="form-check form-check-inline mr-1">
                                        <input class="form-check-input" id="in-active" type="radio" value="0" name="status" {{ $subject->status == 0 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="in-active">In Active</label>
                                    </div>
                                </div>
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