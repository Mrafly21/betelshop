@extends('layouts.app')

@section('title', 'My Order')

@section('content')

    <div class="py-3 py-md-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="shadow bg-white p-3">
                        <h4 class="text-primary">
                            <i class="fa fa-shopping-cart text-dark"></i> My Order Details
                            <a href="{{ url('orders') }}" class="btn btn-danger text-white btn-sm float-end">Back</a>
                        </h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Order Details: </h5>
                                <hr>
                                <h6>Order ID: {{ $order->id }} </h6>
                                <h6>Tracking ID/No.: {{ $order->tracking_no }}</h6>
                                <h6>Order Created Date: {{ $order->created_at->format('d-m-Y h:i A') }} </h6>
                                <h6>Payment Mode: {{ $order->payment_mode }} </h6>
                                <h6 class="border p-2 text-success">Order Status Message: <span
                                        class="text-uppercase">{{ $order->status_message }}</span></h6>
                            </div>
                            <div class="col-md-6">
                                <h5>User Details: </h5>
                                <hr>
                                <h6>Full Name: {{ $order->fullname }} </h6>
                                <h6>Email ID: {{ $order->email }} </h6>
                                <h6>Phone: {{ $order->phone }} </h6>
                                <h6>Address: {{ $order->address }} </h6>
                                <h6>Postcode: {{ $order->pincode }} </h6>
                            </div>
                        </div>
                        <br>
                        <h5>Order Items</h5>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <th>Item ID</th>
                                    <th>Image</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantitiy</th>
                                    <th>Total</th>
                                </thead>
                                <tbody>
                                    @php
                                        $totalprice=0;
                                    @endphp
                                    @foreach ($order->orderItems as $orderitem)
                                        <tr>
                                            <td width="10%">{{ $orderitem->id }}</td>
                                            <td width="10%">
                                                @if ($orderitem->product->productImages)
                                                    <img src="   {{ asset($orderitem->product->productImages[0]->image) }}"
                                                        style="width: 50px; height: 50px"
                                                        alt="  {{ $orderitem->product->name }}">
                                                @else
                                                    <img src="" style="width: 50px; height: 50px" alt="">
                                                @endif
                                            </td>
                                            <td>
                                                {{ $orderitem->product->name }}
                                                @if ($orderitem->productColor)
                                                    @if ($orderitem->productColor->color)
                                                        <span>- Color: {{ $orderitem->productColor->color->name }}</span>
                                                    @endif
                                                @endif
                                            </td>
                                            <td>{{ $orderitem->price }}</td>
                                            <td>{{ $orderitem->quantity }}</td>
                                            <td>{{ $orderitem->quantity * $orderitem->price }}</td>
                                            @php
                                                $totalprice += $orderitem->quantity * $orderitem->price;
                                            @endphp
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="5" class="fw-bold">Total Amount: </td>
                                        <td colspan="1" class="fw-bold">Rp {{ $totalprice }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
