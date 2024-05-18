@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Add Subject</h4>
                    </div>
                    <div class="card-body">
                        @if(Session::has('subject_message'))
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-danger" role="alert">
                                    @foreach(Session::get('subject_message')->all() as $error)
                                    {{ $error }} <br>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif
                        <form method="POST" action="{{ route('subjects.store') }}">
                            @csrf
                            <div class="form-group row">
                                <label>Subject Name</label>
                                <input class="form-control" value="{{ old('name') }}" type="text" minlength="3" maxlength="50" placeholder="Subject Name" name="name" required autofocus />
                            </div>
                            <div class="form-group row">
                                <label>Order</label>
                                <input class="form-control" minlength="1" maxlength="8" type="text" placeholder="Order" name="order" />
                            </div>
                            <button class="btn btn-success" type="submit">Add</button>
                            <a href="{{ route('subjects.index') }}" class="btn btn-primary">Return</a>
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