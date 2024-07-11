@extends('dashboard.base')

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Add Previous Year Paper</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('previous-year-papers.store') }}">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="name">Previous Year Paper</label>
                                    <div class="col-md-9">
                                        <input class="form-control @error('name') is-invalid @enderror" id="name"
                                            type="text" name="name" placeholder="Enter Previous year paper..."
                                            length="160" autocomplete="prevois year paper" autofocus required
                                            value="{{ old('name') }}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="course_id">Course</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="course_id" name="course_id">
                                            <option value="">All</option>
                                            @foreach ($courses as $course)
                                                <option value="{{ $course->id }}" @selected(old('course_id') == $course->id)>
                                                    {{ $course->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('course_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="type">Type</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="type" name="type">
                                            <option value="">Please select</option>
                                            <option value="static">static</option>
                                            <option value="current affairs">current affairs</option>
                                        </select>
                                    </div>
                                </div> --}}
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
                                <a href="{{ route('previous-year-papers.index') }}" class="btn btn-primary">Return</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
