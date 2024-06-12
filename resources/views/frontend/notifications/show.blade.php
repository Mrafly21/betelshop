@extends('layout.app')

@section('title', 'Notification Details')

@section('content')
<div class="container">
    <h1 class="my-4">Notification Details</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $notification->message }}</h5>
            <p class="card-text">Type: {{ $notification->type }}</p>
            <p class="card-text">Status: {{ $notification->status }}</p>
            <p class="card-text"><small class="text-muted">Received {{ $notification->created_at->diffForHumans() }}</small></p>
        </div>
    </div>
    <a href="{{ url('notifications') }}" class="btn btn-primary mt-3">Back to Notifications</a>
</div>
@endsection
    