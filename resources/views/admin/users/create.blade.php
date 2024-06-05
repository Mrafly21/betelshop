@extends('layout.admin')

@section('title', 'User List')
@section('content')
    <div class="row">

        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif

        <div class="col-md-12">
            <div class="card">
                <div class="card-header my-auto">
                    <h3>Add User
                        <a href="{{ url('admin/users/') }}" class="btn btn-warning text-white float-end">
                            Back</a>
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('admin/users') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="name">Name <small>*</small></label>
                                <input type="text" name="name" class="form-control mt-2">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
    
                            <div class="col-md-12 mb-3">
                                <label for="email">Email <small>*</small></label>
                                <input type="text" name="email" class="form-control mt-2">
                                @error('email')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="password">Password <small>*</small></label>
                                <input type="password" name="password" class="form-control mt-2">
                                @error('password')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="role_as">Select Role <small>*</small></label>
                                <select name="role_as" class="form-control mt-2">
                                    <option value="">Select Role</option>
                                    <option value="0">User</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Seller</option>
                                </select>
                                @error('role_as')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-12 text-end">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
