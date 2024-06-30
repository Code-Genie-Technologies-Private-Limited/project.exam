@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Course Subject</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('/course-subjects/' . $courseSubject->id) . '?' . http_build_query($filters) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label for="subject_id" class="col-md-3 col-form-label">Subject</label>
                                <div class="col-md-9">
                                    <select name="subject_id" id="subject" class="form-control">
                                        <option value="">All</option>
                                        @foreach($subjects as $subject)
                                        <option value="{{ $subject->id }}" {{ ($filters['subject'] ?? '') == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="course" class="col-md-3 col-form-label">Course Name</label>
                                <div class="col-md-9">
                                    <select name="course_id" id="course" class="form-control">
                                        <option value="">All</option>
                                        @foreach($courses as $course)
                                        <option value="{{ $course->id }}" {{ ($filters['course'] ?? '') == $course->id ? 'selected' : '' }}>{{ $course->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <button class="btn btn-success" type="submit">Update</button>
                            <a href="{{ url('/course-subjects?' . http_build_query($filters)) }}" class="btn btn-secondary">Back to list</a>
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