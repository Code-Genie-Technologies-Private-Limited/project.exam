@extends('dashboard.base')

@section('content')
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Add Blog</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('notices.store') }}">
                            @csrf
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="title">Title</label>
                                <div class="col-md-9">
                                    <input class="form-control @error('title') is-invalid @enderror" id="title" type="text" name="title" placeholder="Enter Title Name" length="160" autocomplete="title" autofocus required value="{{ old('title') }}">
                                    @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="type" class="col-md-3 col-form-label">Type</label>
                                <div class="col-md-9">
                                    <select name="type" id="type" class="form-control">
                                        <option value="web">Web</option>
                                        <option value="andriod">Andriod</option>

                                    </select>
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