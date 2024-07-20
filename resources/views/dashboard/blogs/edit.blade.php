@extends('dashboard.base')

@section('content')
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Topic</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('/blogs/' . $blog->id) . '?' . http_build_query($filters) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="title">Title</label>
                                <div class="col-md-9">
                                    <input class="form-control" id="title" type="text" name="title" placeholder="Enter title..." autocomplete="title" autofocus required value="{{ old('title') ?? $blog->title }}">
                                    @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="content">Content</label>
                                <div class="col-md-9">
                                    <input class="form-control" id="content" type="text" name="content" placeholder="Enter content..." autocomplete="content" autofocus required value="{{ old('content') ?? $blog->content }}">
                                    @error('content')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="description">Description</label>
                                <div class="col-md-9">
                                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description">{{ old('description') ?? $blog->description }}</textarea>
                                    @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="order">Priority Order</label>
                                <div class="col-md-9">
                                    <input class="form-control" id="order" type="number" name="order" placeholder="Enter Priority Order" step="0.01" value="{{ old('order', number_format($blog->order, 2)) }}">
                                    @error('order')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Status</label>
                                <div class="col-md-9 col-form-label">
                                    <div class="form-check form-check-inline mr-1">
                                        <input class="form-check-input" id="active" type="radio" value="1" name="status" @checked(old('status', $blog->status) == 1)>
                                        <label class="form-check-label" for="active">Active</label>
                                    </div>
                                    <div class="form-check form-check-inline mr-1">
                                        <input class="form-check-input" id="in-active" type="radio" value="0" name="status" @checked(old('status', $blog->status) == 0)>
                                        <label class="form-check-label" for="in-active">In Active</label>
                                    </div>
                                    @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="filename">Upload Dcoument</label>
                                <div class="col-md-9">
                                    <input type="file" name="filename[]" id="filename" multiple>
                                    @error('filename')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="filename">Uploaded Dcoument</label>
                                <div class="col-md-9">
                                    @foreach($blog->blogFileDetails as $detail)
                                    @if(in_array(pathinfo($detail->filename, PATHINFO_EXTENSION), ['jpg', 'png', 'jpeg']))
                                    <img src="{{ asset('public/' . $detail->filename) }}" alt="{{ basename($detail->filename) }}" style="width: 300px; height: 300px; object-fit: cover;">
                                    @else
                                    <iframe src="{{ asset('public/' . $detail->filename) }}" style="width: 300px; height: 300px; border: none;"></iframe>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                            <button class="btn btn-success" type="submit">Update</button>
                            <a href="{{ url('/blogs?' . http_build_query($filters)) }}" class="btn btn-secondary">Back
                                to list</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection