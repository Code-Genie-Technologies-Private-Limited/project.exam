@extends('dashboard.base')

@section('content')
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Add Subject</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('subjects.store') }}">
                            @csrf
                            <div class="form-group row">
                                <div class="col-3"> <label for="name">Name</label></div>
                                <div class="col-9"><input class="form-control" id="name" type="text" placeholder="Name" name="name"  title="Name" required autofocus value="{{ old('name') }}" />
                                    @error('name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <button class="btn btn-success" type="submit">Add</button>
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