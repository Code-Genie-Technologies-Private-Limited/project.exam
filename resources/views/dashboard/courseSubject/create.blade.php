@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Add Student</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('courseSubjects.store') }}">
                            @csrf
                            <div class="form-group row">
                                <label>subject</label>
                                <select class="form-control" id="subject_id" name="subject_id">
                                    @foreach($subjects as $subject)
                                    <option value=""> {{ $subject->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group row">
                                <label>Course</label>
                                <select class="form-control" id="subject_id" name="subject_id">
                                    @foreach($courses as $course)
                                    <option value=""> {{ $course->name }} </option>
                                    @endforeach
                                </select>
                            </div>

                            <button class="btn btn-success" type="submit">Add</button>
                            <a href="{{ route('courseSubjects.index') }}" class="btn btn-primary">Return</a>
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