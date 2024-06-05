@extends('layout.admin')

@section('content')
<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Message</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($messages as $message)
                <tr @if($message->status == 0) style="font-weight:bold;" @endif>
                    <td>{{ $message->name }}</td>
                    <td>{{ $message->email }}</td>
                    <td>{{ Str::limit($message->message, 50) }}</td>
                    <td>{{ $message->status == 0 ? 'Unread' : 'Read' }}</td>
                    <td>
                        <a href="{{ route('admin.messages.show', $message->id) }}" class="btn btn-primary">Details</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
