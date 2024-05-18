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
                        @if(Session::has('topic_message'))
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-danger" role="alert">
                                    @foreach(Session::get('topic_message')->all() as $error)
                                    {{ $error }} <br>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif
                        <form method="POST" action="{{ route('topics.update', $topic->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label>Suject Name</label>
                                <select name="subject_id" id="subject_id" class="form-control">
                                    @foreach($subjects as $subject)
                                    <option {{ $subject->id == $topic->subject_id ? 'selected' : '' }} value="{{ $subject->id }}">{{$subject->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group row">
                                <label>Topic Name</label>
                                <input class="form-control" type="text" minlength="3" maxlength="50" placeholder="Topic Name" name="name" required autofocus value="{{ $topic->name }}" />
                            </div>
                            <div class="form-group row">
                                <label>Order</label>
                                <input class="form-control" type="text" minlength="1" maxlength="8" placeholder="Order" name="order" value="{{ $topic->order }}" />
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Status</label>
                                <div class="col-md-9 col-form-label">
                                    <div class="form-check form-check-inline mr-1">
                                        <input class="form-check-input" id="active" type="radio" value="1" name="status" {{ $topic->status == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="active">Active</label>
                                    </div>
                                    <div class="form-check form-check-inline mr-1">
                                        <input class="form-check-input" id="in-active" type="radio" value="0" name="status" {{ $topic->status == 0? 'checked' : '' }}>
                                        <label class="form-check-label" for="in-active">In Active</label>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-success" type="submit">Edit</button>
                            <a href="{{ route('topics.index') }}" class="btn btn-primary">Return</a>
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