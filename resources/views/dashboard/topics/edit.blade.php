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
                        <form method="POST" action="{{ route('topics.update', $topic->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label>Topic</label>
                                <input class="form-control" type="text" placeholder="Enter your topic" name="name" required autofocus value="{{ old('name') ??  $topic->name }}" />
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="subject">Subject</label>
                                <select name="subject_id" class="form-control" id="subject" required>
                                    @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}" {{ $subject->id == $topic->subject_id ? 'selected' : '' }}>{{ $subject->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Status</label>
                                <div class="col-md-9 col-form-label">
                                    <div class="form-check">
                                        <input class="form-check-input" id="active" type="radio" value="1" name="status" {{$topic->status == 1 ? 'checked':''}}>
                                        <label class="form-check-label" for="active">Active</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" id="inactive" type="radio" value="0" name="status" {{$topic->status == 0 ? 'checked':'' }}>
                                        <label class="form-check-label" for="inactive">Inactive</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label>Order</label>
                                <input class="form-control" type="text" placeholder="order" name="order" required value="{{ $topic->order }}" />
                                @error('order')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button class="btn btn-success" type="submit">Update</button>
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