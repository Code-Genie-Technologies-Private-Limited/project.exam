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
                            <div class="row">

                                <div class="col-3"> <label for="name">Name</label></div>
                                <div class="col-9">
                                    <div class="form-group">
                                        <input class="form-control" type="text" placeholder="Name" id="name" name="name" title="{{ $subject->name}}" required autofocus value="{{ $subject->name }}" />
                                        @error('name')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-3"> <label> Order</label></div>
                                <div class="col-9">
                                    <input class="form-control" type="number" step="0.01" placeholder="Order" name="order" required value="{{ $subject->order }}" />
                                    @error('order')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-3">Status</div>
                                <div class="col-2 col-form-label">
                                    <div class="form-check">
                                        <input class="form-check-input" id="active" type="radio" value="1" name="status" {{$subject->status == 1? 'checked':''}}>
                                        <label class="form-check-label" for="active">Active</label>
                                    </div>
                                </div>
                                <div class="col-6 col-form-label">
                                    <div class="form-check">
                                        <input class="form-check-input" id="inactive" type="radio" value="0" name="status" {{$subject->status == 0? 'checked':''}}>
                                        <label class="form-check-label" for="inactive">Inactive</label>
                                    </div>
                                </div>

                            </div>
                            <button class="btn btn-success" type="submit">Update</button>
                            <a href="{{ route('subjects.index') }}" class="btn btn-primary">Return</a>
                    </div>



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