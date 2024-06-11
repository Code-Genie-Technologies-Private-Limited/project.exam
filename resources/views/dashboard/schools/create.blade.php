@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Add School</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('schools.store') }}">
                            @csrf
                            <div class="form-group row">
                                <label>School Name</label>
                                <input class="form-control" value="{{ old('name') }}" type="text" placeholder="School Name" title="School Name" name="name" required autofocus />
                                @error('name')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label>Address</label>
                                <input class="form-control" value="{{ old('address') }}" type="text" placeholder="address" title="address" name="address" required autofocus />
                                @error('name')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <button class="btn btn-success" type="submit">Add</button>
                            <a href="{{ route('schools.index') }}" class="btn btn-primary">Return</a>
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