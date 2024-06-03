@extends('layout.app')

@section('title', 'Checkout Order')

@section('content') 
<div>
    <div class="py-3 py-md-4 checkout">
        <div class="container">
            <h4>Checkout</h4>
            <hr>
            @if ($totalProductAmount != '0')
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <div class="shadow bg-white p-3">
                            <h4 class="text-primary">
                                Item Total Amount:
                                <span class="float-end">Rp {{ number_format($totalProductAmount, 2) }}</span>
                            </h4>
                            <hr>
                            <small>* Items will be delivered in 3 - 5 days.</small>
                            <br />
                            <small>* Tax and other charges are included.</small>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="shadow bg-white p-3">
                            <h4 class="text-primary">Basic Information</h4>
                            <hr>
                            <form action="{{ route('checkout.process') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label>Full Name</label>
                                        <input type="text" name="fullname" class="form-control" placeholder="Enter Full Name" required>
                                        @error('fullname')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label>Phone Number</label>
                                        <input type="number" name="phone" class="form-control" placeholder="Enter Phone Number" required>
                                        @error('phone')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label>Email Address</label>
                                        <input type="email" name="email" class="form-control" placeholder="Enter Email Address" required>
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label>Pin-code (Zip-code)</label>
                                        <input type="number" name="pincode" class="form-control" placeholder="Enter Pin-code" required>
                                        @error('pincode')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label>Full Address</label>
                                        <textarea name="address" class="form-control" rows="2" required></textarea>
                                        @error('address')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label>Select Payment Mode:</label>
                                        <select name="payment_mode" class="form-control">
                                            <option value="Cash on Delivery">Cash on Delivery</option>
                                            <option value="Shopee">Shopee</option>
                                            <option value="Tokopedia">Tokopedia</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary">Place Order</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <div class="card shadow p-3">
                    <div class="card-body text-center">
                        <h4>No items in cart to checkout</h4>
                        <a class="btn btn-warning" href="{{ url('collections') }}">Shop Now</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
