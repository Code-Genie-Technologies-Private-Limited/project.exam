@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit topic</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('topics.update', $topic->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label for="name">Name</label>
                                <input class="form-control" type="text" placeholder="Name" name="name" id="name" required autofocus value="{{ old('name', $topic->name) }}" />
                                @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group row">
                                <label for="subject">Subject</label>
                                <select name="subject_id" class="form-control" id="subject" required>
                                    @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}" {{ old('subject_id', $topic->subject_id) == $subject->id ? 'selected' : '' }}>
                                        {{ $subject->name }}
                                    </option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Status</label>
                                <div class="col-md-9 col-form-label">
                                    <div class="form-check">
                                        <input class="form-check-input" id="radio1" type="radio" value="1" name="status" {{ $topic->status == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="radio1">Active</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" id="radio2" type="radio" value="0" name="status" {{ $topic->status == 0 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="radio2">Deactive</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label>Order</label>
                                <input class="form-control" type="text" placeholder="Order" name="order" required autofocus value="{{ $topic->order }}" />
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