@extends('layout.admin')

@section('title', 'My Order')

@section('content') 

<div class="py-1 py-md-1">
    <div class="">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>My Orders</h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="GET">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="">Filter by Date</label>
                                    <input type="date" name="date" value="{{ Request::get('date') ?? date('Y-m-d') }}" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label for="">Filter by Status</label>
                                    <select name="status" class="form-select">
                                        <option value="">Select All Status</option>
                                        <option value="in progress">In Progress</option>
                                        <option value="completed">Completed</option>
                                        <option value="pending">Pending</option>
                                        <option value="canceled">Canceled</option>
                                        <option value="out-for-delivery"> Out of Delivery</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <br>
                                    <button class="btn btn-primary" type="submit">Filter</button>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <th>Order ID</th>
                                    <th>Tracking No</th>
                                    <th>Username</th>
                                    <th>Payment Mode</th>
                                    <th>Ordered Date</th>
                                    <th>Status Message</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                        <tr>
                                            <td>123</td>
                                            <td>232333CSE</td>
                                            <td>Rafael Struick</td>
                                            <td>COD</td>
                                            <td>22 - 04 - 2024</td>
                                            <td>Out of Delivery</td>
                                            <td>
                                                <a href="{{ url('admin/order/') }}" class="btn btn-primary btn-sm">View</a>
                                            </td>
                                            <td></td>
                                        </tr>
                                </tbody>
                            </table>
                            {{-- <div>
                                {{ $orders->links() }}
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection