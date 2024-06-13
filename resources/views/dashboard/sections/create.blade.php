@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Add Section</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('sections.store') }}">
                            @csrf
                            <div class="form-group row">
                                <label>Section Name</label>
                                <input class="form-control" value="{{ old('name') }}" type="text" placeholder="Section Name" title="Section Name" name="name" required autofocus />
                                @error('name')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <button class="btn btn-success" type="submit">Add</button>
                            <a href="{{ route('sections.index') }}" class="btn btn-primary">Return</a>
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