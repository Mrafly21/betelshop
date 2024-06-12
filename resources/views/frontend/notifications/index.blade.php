@extends('layout.app')

@section('title', 'Notifications')

@section('content')
<div class="container">
    <h1 class="my-4">Notifications</h1>
    @if ($notifications->isEmpty())
        <p>No notifications found.</p>
    @else
        <ul class="list-group">
            @foreach ($notifications as $notification)
                <li class="list-group-item {{ $notification->status == 'unread' ? 'list-group-item-info' : '' }}">
                    <a href="{{ url('notifications/' . $notification->id) }}">{{ $notification->message }}</a>
                    <span class="badge bg-secondary">{{ $notification->created_at->diffForHumans() }}</span>
                </li>
            @endforeach
        </ul>
        {{ $notifications->links() }}
    @endif
</div>
@endsection
