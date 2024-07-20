@extends('documents.base')
@section('content')
<div>
    <h1>Blog Details</h1>
    <p>Date: {{ now()->toFormattedDateString() }}</p>
</div>

<div class="content">
    <h4>Blog: {{ $data['title'] }}</h4>
    <p><strong>Ttile:</strong> {{ $data['title'] }}</p>
    <p><strong>Content:</strong> {{ $data['content'] }}</p>
    <p><strong>Description:</strong> {!! $data['description'] !!}</p>
    <p><strong>Order:</strong> {{ $data['order'] }}</p>
    <p><strong>Status:</strong> {{ $data['status'] == 1 ? 'Active' : 'Inactive' }}</p>
    <p><strong>Created By:</strong> {{ $data['creator']['name'] }}</p>
</div>
@endsection