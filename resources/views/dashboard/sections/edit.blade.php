@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Section</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('sections.update', $section->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label for="name">Name</label>
                                <input class="form-control" type="text" id="name" placeholder="Name" name="name" required autofocus value="{{ old('name',$section->name) }}" />
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Staus</label>
                                <div class="col-md-9 col-form-label">
                                    <div class="form-check">
                                        <input class="form-check-input" id="Active" type="radio" value="1" name="status" {{ $section->status == 1 ? 'checked': '' }}>
                                        <label class="form-check-label" for="Active">Active</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" id="Inactive" type="radio" value="0" name="status" {{ $section->status == 0 ? 'checked': '' }}>
                                        <label class="form-check-label" for="Inactive">Inactive</label>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-success" type="submit">Update</button>
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