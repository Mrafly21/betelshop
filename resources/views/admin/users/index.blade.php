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
                                    <tr>
                                        <td>1</td>
                                        <td>Muhammad Rafly</td>
                                        <td>mrafly@graduate.utm.my</td>
                                        <td>
                                            <label class="badge btn-primary">Admin</label>
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-warning my-2"
                                                href="{{ url('admin/users/change-password') }}">Change Password</a>
                                            <a class="btn btn-sm btn-success my-2"
                                                href="{{ url('admin/users/edit') }}">Edit</a>
                                            <a class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure want to delete this product?')"
                                                href="{{ url('admin/users/delete') }}">Delete</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Rafael Struick</td>
                                        <td>rafael@gmai.com</td>
                                        <td>
                                            <label class="badge btn-warning">User</label>
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-warning my-2"
                                                href="{{ url('admin/users/change-password') }}">Change Password</a>
                                            <a class="btn btn-sm btn-success my-2"
                                                href="{{ url('admin/users/edit') }}">Edit</a>
                                            <a class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure want to delete this product?')"
                                                href="{{ url('admin/users/delete') }}">Delete</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Budi Sudarsono</td>
                                        <td>budi@gmail.com</td>
                                        <td>
                                            <label class="badge btn-success">Seller</label>
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-warning my-2"
                                                href="{{ url('admin/users/change-password') }}">Change Password</a>
                                            <a class="btn btn-sm btn-success my-2"
                                                href="{{ url('admin/users/edit') }}">Edit</a>
                                            <a class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure want to delete this product?')"
                                                href="{{ url('admin/users/delete') }}">Delete</a>
                                        </td>
                                    </tr>
                                {{-- @empty
                                    <td colspan="5">No Users Available</td>
                                @endforelse --}}
                            </tbody>
                        </table>
                    </div>
                    {{-- <div>
                        {{ $users->links() }}
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
