@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit branch</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('branchs.update', $branch->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label>Branch Code</label>
                                <input class="form-control" type="text" placeholder="Branch Code" name="branch_code" required autofocus value="{{ $branch->branch_code }}" />
                            </div>
                            <div class="form-group row">
                                <label>Branch Name</label>
                                <input class="form-control" type="text" placeholder="branch name" name="branch_name" required value="{{ $branch->branch_name }}" />
                            </div>
                            <div class="form-group row">
                                <label>Date</label>
                                <input class="form-control" type="date" placeholder="Start Date" name="start_date" required value="{{ $branch->start_date}}" />
                            </div>

                            <button class="btn btn-success" type="submit">Edit</button>
                            <a href="{{ route('branchs.index') }}" class="btn btn-primary">Return</a>
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