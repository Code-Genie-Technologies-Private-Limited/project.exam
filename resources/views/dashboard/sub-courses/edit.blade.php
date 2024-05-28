@extends('dashboard.base')

@section('content')
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Subject</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('sub-courses.update', $subCourse->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label>Sub Course</label>
                                <input class="form-control" type="text" placeholder="Sub Course" name="name" required autofocus value="{{ $subCourse->name }}" />
                            </div>
                            <div class="form-group row">
                                <label> Order</label>
                                <input class="form-control" type="number" step="0.01" placeholder="Order" name="order" required value="{{ $subCourse->order }}" />
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Status</label>
                                <div class="col-md-9 col-form-label">
                                    <div class="form-check">
                                        <input class="form-check-input" id="active" type="radio" value="1" name="status" {{$subCourse->status == 1? 'checked':''}}>
                                        <label class="form-check-label" for="active">Active</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" id="inactive" type="radio" value="0" name="status" {{$subCourse->status == 0? 'checked':''}}>
                                        <label class="form-check-label" for="inactive">Inactive</label>
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