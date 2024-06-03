@extends('layout.admin')

@section('title', 'User List')
@section('content')
    <div class="row">

        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>User
                        <a href="{{ url('admin/users/create') }}" class="btn btn-primary text-white float-end">
                            Add User</a>
                    </h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if ($user->role_as == 0)
                                                <label class="badge btn-warning">User</label>
                                            @elseif($user->role_as == 1)
                                                <label class="badge btn-primary">Admin</label>
                                            @elseif($user->role_as == 2)
                                            <label class="badge btn-secondary">Seller</label>
                                            @else
                                                <label class="badge btn-primary">None</label>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-warning my-2"
                                                href="#">Send Warning</a>
                                            <a class="btn btn-sm btn-success my-2"
                                                href="{{ url('admin/users/' . $user->id . '/edit') }}">Edit</a>
                                            <a class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure want to delete this product?')"
                                                href="{{ url('admin/users/' . $user->id . '/delete') }}">Delete</a>
                                        </td>
                                    </tr>
                                @empty
                                    <td colspan="5">No Users Available</td>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div>
                        {{-- {{ $users->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
