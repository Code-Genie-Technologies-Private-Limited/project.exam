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
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="subject"><b>Name</b></label>
                                        <input class="form-control" type="text" id="subject" placeholder="Enter your subject name" name="name" title="{{ $subject->name }}" required autofocus value="{{ old('name', $subject->name) }}" />
                                        @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="order"><b>Order</b> </label>
                                        <input class="form-control" type="text" id="order" placeholder="Order" name="order" title="{{ $subject->order }}" value="{{ $subject->order }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-md-1 col-form-label"> <b>Status</b></label>
                                    <div class="col-1 col-form-label">
                                        <div class="form-check">
                                            <input class="form-check-input" id="radio1" type="radio" value="1" name="status" {{$subject->status==1?'checked':''}}>
                                            <label class="form-check-label" for="radio1">Active</label>
                                        </div>
                                    </div>
                                    <div class="col-10 col-form-label">
                                        <div class="form-check">
                                            <input class="form-check-input" id="radio2" type="radio" value="0" name="status" {{$subject->status==0?'checked':''}}>
                                            <label class="form-check-label" for="radio2">De-active</label>
                                        </div>
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