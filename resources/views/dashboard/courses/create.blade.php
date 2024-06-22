@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Add Course</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('courses.store') }}">
                            @csrf
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="name">Course Name</label>
                                <div class="col-md-9">
                                    <input class="form-control @error('name') is-invalid @enderror" id="name" type="text" name="name" placeholder="Enter Course Name" length="160" autocomplete="course" autofocus required value="{{ old('name') }}">
                                    @error('name')
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
                            <button class="btn btn-success" type="submit">Add</button>
                            <a href="{{ route('courses.index') }}" class="btn btn-primary">Return</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')
<!-- Include TinyMCE from CDN -->
<script src="https://cdn.tiny.cloud/1/uc3ovxfl48d9aye0eek5ugch5zzqgaqsa9lckdlhni364yvz/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount  linkchecker',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
        ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
    });
</script>
@endsection