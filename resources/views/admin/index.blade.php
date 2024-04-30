@extends('layout.admin')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="me-md-3 me-xl-5">
                <h2>Welcome back, {{ Auth::user()->name }}</h2>
                <p class="mb-md-0">Your analytics dashboard template.</p>
                <a href="{{ url('/') }}" class="btn btn-dark my-2 text-white">View User Page</a>
                <hr>
                <h2 class="text-end me-md-3">{{ $todayDate }} | {{ $timeNow }}</h2>
            </div>
            
            <div class="row me-md-3 me-xl-5">
                <div class="col-md-3">
                    <div class="card card-body bg-dark text-white mb-3">
                        <label class="mb-3">Total Orders</label>
                        <h1>3</h1>
                        <a href="{{ url('admin/order') }}" class="text-white text-decoration-none">View</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-body bg-danger text-white mb-3">
                        <label class="mb-3">Total Orders Today</label>
                        <h1>21</h1>
                        <a href="{{ url('admin/order') }}" class="text-white text-decoration-none">View</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-body bg-primary text-white mb-3">
                        <label class="mb-3">Total Orders Monthly</label>
                        <h1>4</h1>
                        <a href="{{ url('admin/order') }}" class="text-white text-decoration-none">View</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-body bg-warning text-white mb-3">
                        <label class="mb-3">Total Orders This Years</label>
                        <h1>3</h1>
                        <a href="{{ url('admin/order') }}" class="text-white text-decoration-none">View</a>
                    </div>
                </div>
                <hr>
            </div>
            <div class="row me-md-3 me-xl-5">
                <div class="col-md-3">
                    <div class="card card-body bg-danger text-white mb-3">
                        <label class="mb-3">Total Sliders</label>
                        <h1>2</h1>
                        <a href="{{ url('admin/sliders') }}" class="text-white text-decoration-none">View</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-body bg-primary text-white mb-3">
                        <label class="mb-3">Total Products</label>
                        <h1>10</h1>
                        <a href="{{ url('admin/products') }}" class="text-white text-decoration-none">View</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-body bg-success text-white mb-3">
                        <label class="mb-3">Total Categories</label>
                        <h1>3</h1>
                        <a href="{{ url('admin/category') }}" class="text-white text-decoration-none">View</a>
                    </div>
                </div>
                <hr>
            </div>
            <div class="row me-md-3 me-xl-5">
                <div class="col-md-3">
                    <div class="card card-body bg-warning text-white mb-3">
                        <label class="mb-3">Total All Users</label>
                        <h1>5</h1>
                        <a href="{{ url('admin/users') }}" class="text-white text-decoration-none">View</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-body bg-success text-white mb-3">
                        <label class="mb-3">Total User</label>
                        <h1>3</h1>
                        <a href="{{ url('admin/users') }}" class="text-white text-decoration-none">View</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-body bg-primary text-white mb-3">
                        <label class="mb-3">Total Admin</label>
                        <h1>2</h1>
                        <a href="{{ url('admin/users') }}" class="text-white text-decoration-none">View</a>
                    </div>
                </div>
            </div>
        </div>
    @endsection
