@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4>subCourses: {{ $subCourses->name }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <h4>Name</h4>
                            </div>
                            <div class="col-6">
                                <p>{{ $subCourses->name }}</p>
                            </div>
                            <div class="col-6">
                                <h4>Subject</h4>
                            </div>
                            <div class="col-6">
                                <p>{{ $subCourses->subject->name }}</p>
                            </div>
                            <div class="col-6">
                                <h4>Created By</h4>
                            </div>
                            <div class="col-6">
                                <p>{{ $subCourses->creator->name }}</p>
                            </div>
                            <div class="col-6">
                                <h4>Order</h4>
                            </div>
                            <div class="col-6">
                                <p>{{$subCourses->order}}</p>
                            </div>
                            <div class="col-6">
                                <h4>Status</h4>
                            </div>
                            <div class="col-6">
                                <p>{{$subCourses->status==1?'Active':'Deactive'}}</p>
                            </div>
                            
                        </div>









                        <a href="{{ route('subCoursess.index') }}" class="btn btn-primary">Return</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')

@endsection