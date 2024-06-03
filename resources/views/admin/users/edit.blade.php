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
                    <h3>Edit User
                        <a href="{{ url('admin/users/') }}" class="btn btn-warning float-end">
                            Back</a>
                            <a href="{{ url('admin/users/change-password') }}" class="btn btn-success float-end me-3">Change Password</a>
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('admin/users/'.$user->id) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="name">Name <small>*</small></label>
                                <input type="text" name="name" value="{{ $user->name }}" class="form-control mt-2">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
    
                            <div class="col-md-12 mb-3">
                                <label for="email">Email <small>*</small></label>
                                <input type="text" readonly name="email" value="{{ $user->email }}" class="form-control mt-2">
                                @error('email')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="role_as">Select Role <small>*</small></label>
                                <select name="role_as" class="form-control mt-2">
                                    <option value="">Select Role</option>
                                    <option value="0" {{ $user->role_as == '0' ? 'selected' : '' }}>User</option>
                                    <option value="1" {{ $user->role_as == '1' ? 'selected' : '' }}>Admin</option>
                                    <option value="2" {{ $user->role_as == '2' ? 'selected' : '' }}>Seller</option>
                                </select>
                                @error('role_as')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-12 text-end">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
