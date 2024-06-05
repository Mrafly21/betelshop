@extends('layout.admin')

@section('content')
<div class="container">
    <h1>Message Details</h1>
    <p><strong>From:</strong> {{ $message->name }} ({{ $message->email }})</p>
    <p><strong>Message:</strong> {{ $message->message }}</p>
    <p><strong>Received On:</strong> {{ $message->created_at->format('d M Y H:i') }}</p>
    <p><strong>Status:</strong> {{ $message->status == 0 ? 'Unread' : 'Read' }}</p>
</div>
@endsection
