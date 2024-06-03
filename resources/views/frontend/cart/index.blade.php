@extends('layout.app')

@section('title', 'Cart List')

@section('content') 
<div class="py-3 py-md-5 bg-light">
    <div class="container">
        @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
        @endif
        <div class="shopping-cart">
            <h4>My Cart</h4>
            <hr>
            <div class="cart-header d-none d-md-block">
                <div class="row">
                    <div class="col-md-4">Products</div>
                    <div class="col-md-2">Price</div>
                    <div class="col-md-2">Quantity</div>
                    <div class="col-md-2">Total</div>
                    <div class="col-md-2">Remove</div>
                </div>
            </div>
            @forelse ($cartlist as $item)
            <div class="cart-item">
                <div class="row">
                    <div class="col-md-4 my-auto">
                        <a href="{{ url('collections/' .$item->product->category->slug.'/'.$item->product->slug) }}">
                            <img src="{{ $item->product->productImages->first()->image ?? 'default.jpg' }}"
                                 style="width: 50px; height: 50px;" alt="{{ $item->product->name }}">
                            {{ $item->product->name }}
                        </a>
                    </div>
                    <div class="col-md-2 my-auto">Rp {{ $item->product->selling_price }}</div>
                    <div class="col-md-2 my-auto">
                        <form action="{{ route('cart.decrement', $item->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm"><i class="fa fa-minus"></i></button>
                        </form>
                        {{ $item->quantity }}
                        <form action="{{ route('cart.increment', $item->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm"><i class="fa fa-plus"></i></button>
                        </form>
                    </div>
                    <div class="col-md-2 my-auto">Rp {{ $item->product->selling_price * $item->quantity }}</div>
                    <div class="col-md-2 my-auto">
                        <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Remove</button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <h4>No items in cart. Go shopping.</h4>
            @endforelse
        </div>
        <div class="row mt-3">
            <div class="col-md-8">
                <h5>Get the best deals & offers <a href="{{ url('/collections') }}">shop now</a></h5>
            </div>
            <div class="col-md-4">
                <div class="shadow-sm bg-white p-3">
                    <h4>Total: <span class="float-end">Rp {{ $totalPrice }}</span></h4>
                    <hr>
                    <a href="{{ url('/checkout') }}" class="btn btn-warning w-100">Checkout</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
