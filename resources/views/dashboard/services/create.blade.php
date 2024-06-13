@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Add Service</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('services.store') }}">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label for='name'><b>Name</b></label>
                                </div>
                                <div class="col-md-9">
                                    <input class="form-control" type="text" id="name" placeholder="Name" name="name" required autofocus value="{{old('name')}}" />
                                </div>
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button class="btn btn-success" type="submit">Add</button>
                            <a href="{{ route('services.index') }}" class="btn btn-primary">Return</a>
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