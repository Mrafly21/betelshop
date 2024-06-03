@extends('layouts.app')

@section('title', 'My Order')

@section('content') 

<div class="py-3 py-md-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="shadow bg-white p-3">
                   <h4>My Order</h4>
                    <hr>
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
                                @forelse ($orders as $Orderitem)
                                    <tr>
                                        <td>{{ $Orderitem->id }}</td>
                                        <td>{{ $Orderitem->tracking_no }}</td>
                                        <td>{{ $Orderitem->fullname }}</td>
                                        <td>{{ $Orderitem->payment_mode }}</td>
                                        <td>{{ $Orderitem->created_at->format('d-m-Y') }}</td>
                                        <td>{{ $Orderitem->status_message }}</td>
                                        <td><a href="{{ url('orders/'.$Orderitem->id) }}" class="btn btn-primary btn-sm">View</a></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">No Orders Available</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div>
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection