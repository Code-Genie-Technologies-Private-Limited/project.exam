@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Add Teacher</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('teachers.store') }}">
                            @csrf
                            <div class="form-group row">
                                <label for='name'>Name</label>
                                <input class="form-control" type="text" id="name" placeholder="Name" name="name" required autofocus value="{{old('name')}}" />
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="school_id">School</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="school_id" name="school_id">
                                        @foreach($schools as $school)
                                        <option value="{{ $school->id }}" @selected( old('school_id')==$school->id)>{{ $school->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('school_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <button class="btn btn-success" type="submit">Add</button>
                            <a href="{{ route('teachers.index') }}" class="btn btn-primary">Return</a>
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