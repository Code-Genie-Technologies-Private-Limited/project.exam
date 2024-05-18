@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Course</h4>
                    </div>
                    <div class="card-body">
                        @if(Session::has('course_message'))
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-danger" role="alert">
                                    @foreach(Session::get('course_message')->all() as $error)
                                    {{ $error }} <br>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif
                        <form method="POST" action="{{ route('courses.update', $course->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label>Course Name</label>
                                <input class="form-control" type="text" minlength="3" maxlength="50" placeholder="Course Name" name="name" required autofocus value="{{ $course->name }}" />
                            </div>
                            <div class="form-group row">
                                <label>Order</label>
                                <input class="form-control" type="text" minlength="1" maxlength="8" placeholder="Order" name="order" value="{{ $course->order }}" />
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Status</label>
                                <div class="col-md-9 col-form-label">
                                    <div class="form-check form-check-inline mr-1">
                                        <input class="form-check-input" id="active" type="radio" value="1" name="status" {{ $course->status == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="active">Active</label>
                                    </div>
                                    <div class="form-check form-check-inline mr-1">
                                        <input class="form-check-input" id="in-active" type="radio" value="0" name="status" {{ $course->status == 0? 'checked' : '' }}>
                                        <label class="form-check-label" for="in-active">In Active</label>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-success" type="submit">Edit</button>
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

@endsection