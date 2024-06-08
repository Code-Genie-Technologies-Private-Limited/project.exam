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
                        <form method="POST" action="{{ route('sub-courses.update', $subCourse->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label>subCourse Name</label>
                                <input class="form-control" type="text" placeholder="subCourse Name" title="subCourse Name" name="name" required autofocus value="{{old('name',$subCourse->name) }}" />
                                @error('name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label>Order</label>
                                <input class="form-control" type="text" placeholder="Order" title="order" name="order" required value="{{ old('order',$subCourse->order) }}" />
                                @error('order')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="course_id">Course</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="course_id" name="course_id">
                                        @foreach($courses as $course)
                                        <option value="{{ $course->id }}" {{$course->id ==$subCourse->course_id? 'selected':''}}> {{$course->name}} </option>
                                        @endforeach
                                    </select>
                                    @error('course_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Status</label>
                                <div class="col-md-9 col-form-label">
                                    <div class="form-check">
                                        <input class="form-check-input" id="radio1" type="radio" value="1" name="status" {{$subCourse->status ==1 ? 'checked':''}}>
                                        <label class="form-check-label" for="radio1">Active</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" id="radio2" type="radio" value="0" name="status" {{$subCourse->status ==0 ? 'checked':''}}>
                                        <label class="form-check-label" for="radio2">Inactive</label>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-success" type="submit">Update</button>
                            <a href="{{ route('sub-courses.index') }}" class="btn btn-primary">Return</a>
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