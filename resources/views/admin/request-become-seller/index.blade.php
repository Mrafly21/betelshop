@extends('layout.admin')

@section('content')
    <div class="row">

        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>User Request Become Seller</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Details</th>
                                    <th>Contact Number</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($requestSellers as $requestSeller)
                                    <tr>
                                        <td>{{ $requestSeller->id }}</td>
                                        <td>{{ $requestSeller->user_name }}</td>
                                        <td>{{ $requestSeller->email }}</td>
                                        <td>{{ $requestSeller->description }}</td>
                                        <td>{{ $requestSeller->contact_number }}</td>
                                        <td>
                                            <form action="{{ route('admin.request-become-seller.accept', $requestSeller->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success">Accept</button>
                                            </form>
                                            <form action="{{ route('admin.request-become-seller.reject', $requestSeller->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to reject this request?')">Reject</button>
                                            </form>
                                            <a class="btn btn-sm btn-info" href="https://wa.me/{{ $requestSeller->contact_number }}" target="_blank">Contact the User</a>
                                        </td>
                                    </tr>
                                @empty
                                    <td colspan="6">No Requests at this time</td>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
