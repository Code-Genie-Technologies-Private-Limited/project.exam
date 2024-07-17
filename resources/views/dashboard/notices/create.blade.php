@extends('dashboard.base')

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Add Notice</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('notices.store') }}">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="title">Notice Name</label>
                                    <div class="col-md-9">
                                        <input class="form-control @error('title') is-invalid @enderror" id="title"
                                            type="text" name="title" placeholder="Enter Notice Name" length="160"
                                            autocomplete="notice" autofocus required value="{{ old('title') }}">
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="description">Description</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description">{{ old('description') }}</textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="type">Type</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="type" name="type">
                                            <option value="">Please select</option>
                                            <option value="mobile application">mobile application</option>
                                            <option value="web application">web application</option>
                                        </select>
                                    </div>
                                </div>
                                <button class="btn btn-success" type="submit">Add</button>
                                <a href="{{ route('notices.index') }}" class="btn btn-primary">Return</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
