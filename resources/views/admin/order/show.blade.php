@extends('layout.admin')

@section('title', 'My Order Details')

@section('content')

    <div class="py-1 py-md-1">
        <div class="">
            <div class="row">
                @if (session('message'))
                <div class="alert alert-success mb-3">
                    {{ session('message') }}
                </div>
                @endif
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>My Orders</h3>
                        </div>
                        <div class="card-body">
                            <h4 class="text-primary">
                                <i class="fa fa-shopping-cart text-dark"></i> My Order Details

                                <a href="{{ url('admin/order') }}" class="btn btn-danger text-white btn-sm float-end mx-1">Back</a>
                                <a href="{{ url('admin/invoice/'.$order->id) }}" target="_blank"  class="btn btn-warning text-white btn-sm float-md-end my-1 mx-md-1">View Invoice</a>
                                <a href="{{ url('admin/invoice/'.$order->id.'/generate') }}" class="btn btn-success text-white btn-sm float-md-end my-1 mx-md-1">Download Invoice</a>
                                <button class="btn btn-primary btn-sm float-md-end mx-md-1 my-1" id="editOrderButton">Edit</button>
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
                                        <th>Original Price</th>
                                        <th>Price</th>
                                        <th>Quantitiy</th>
                                        <th>Total</th>
                                        <th>Profit</th>
                                    </thead>
                                    <tbody>
                                        @php
                                            $totalprice = 0;
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
                                                        <img src="" style="width: 50px; height: 50px"
                                                            alt="">
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $orderitem->product->name }}
                                                    @if ($orderitem->productColor)
                                                        @if ($orderitem->productColor->color)
                                                            <span>- Color:
                                                                {{ $orderitem->productColor->color->name }}</span>
                                                        @endif
                                                    @endif
                                                </td>
                                                <td>{{ $orderitem->original_price }}</td>
                                                <td>{{ $orderitem->price }}</td>
                                                <td>{{ $orderitem->quantity }}</td>
                                                <td>{{ $orderitem->quantity * $orderitem->price }}</td>
                                                <td>{{ $orderitem->quantity * $orderitem->price - $orderitem->quantity * $orderitem->original_price }}</td>
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

                    <div class="card border mt-3">
                        <div class="card-body">
                            <h4>Order Process (Order Status Update)</h4>
                            <hr>
                            <div class="row">
                                <div class="col-md-5">
                                    <form action="{{ url('admin/order/'.$order->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        
                                        <label for="">Update the Order Status</label>
                                        <input type="hidden" name="action" value="update_status">
                                        <div class="input-group">
                                            <select name="update_status" class="form-select">
                                                <option value="">Select Order Status</option>
                                                <option value="in progress" {{ Request::get('status') == 'in progress' ? 'selected':'' }}>In Progress</option>
                                                <option value="completed" {{ Request::get('status') == 'completed' ? 'selected':'' }}>Completed</option>
                                                <option value="pending" {{ Request::get('status') == 'pending' ? 'selected':'' }}>Pending</option>
                                                <option value="canceled" {{ Request::get('status') == 'canceled' ? 'selected':'' }}>Canceled</option>
                                                <option value="out-for-delivery" {{ Request::get('status') == 'out-for-delivery' ? 'selected':'' }}> Out of Delivery</option>
                                            </select>
                                            <button type="submit" class="btn btn-primary text-white">Update</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-7">
                                    <br>
                                    <h4 class="mt-3">Current Order Status: <span class="text-uppercase text-success">{{ $order->status_message }}</span></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card border mt-3" id="editOrderForm" style="display: none;">
                        <div class="card-body">
                            <h5 class="card-title">Edit Order Details</h5>
                            <form action="{{ url('admin/order/'.$order->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="action" value="update_details">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label>Full Name</label>
                                        <input type="text" wire:model.defer="fullname" name="fullname" value="{{ $order->fullname }}" class="form-control"
                                            placeholder="Enter Full Name" />
                                        @error('fullname')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label>Phone Number</label>
                                        <input type="number" wire:model.defer="phone" name="phone" value="{{ $order->phone }}" class="form-control"
                                            placeholder="Enter Phone Number" />
                                        @error('phone')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label>Email Address</label>
                                        <input type="email" wire:model.defer="email" name="email" value="{{ $order->email }}" class="form-control"
                                            placeholder="Enter Email Address" />
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label>Pin-code (Zip-code)</label>
                                        <input type="number" wire:model.defer="pincode" name="pincode" value="{{ $order->pincode }}" class="form-control"
                                            placeholder="Enter Pin-code" />
                                        @error('pincode')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label>Full Address</label>
                                        <textarea wire:model.defer="address" class="form-control" name="address" rows="2">{{ $order->address }}</textarea>
                                        @error('address')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>                                    
                                    <div class="col-md-6 mb-3">
                                        <label>Select Payment Mode: </label>
                                        <select type="option" wire:model.defer="payment" name="payment" class="form-control">
                                            <option value="Cash of Delivery" {{ $order->payment_mode == 'Cash of Delivery' ? 'selected' : '' }}>Cash of Delivery (COD)</option>
                                            <option value="Shopee" {{ $order->payment_mode == 'Shopee' ? 'selected' : '' }}>Shopee</option>
                                            <option value="Tokopedia" {{ $order->payment_mode == 'Tokopedia' ? 'selected' : '' }}>Tokopedia</option>
                                        </select>                                        
                                        @error('payment')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label>Shipping Number</label>
                                        <input type="text" wire:model.defer="shipping" name="shipping" value="{{ $order->tracking_no }}" class="form-control"
                                            placeholder="Enter Shipping Number" />
                                        @error('shipping')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary float-end">Save</button>   
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const editOrderButton = document.getElementById('editOrderButton');
                const editOrderForm = document.getElementById('editOrderForm');
    
                editOrderButton.addEventListener('click', function() {
                    editOrderForm.style.display = 'block';
                });
            });
        </script>
    @endsection
