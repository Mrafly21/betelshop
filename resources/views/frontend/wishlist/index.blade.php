@extends('layout.app')

@section('title', 'Wishlist')

@section('content')
    <div class="py-3 py-md-5 bg-light">
        <div class="container">
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="shopping-cart">
                        @forelse ($wishlist as $item)
                            @if ($loop->first)
                                <div class="cart-header">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h4>Products</h4>
                                        </div>
                                        <div class="col-md-2">
                                            <h4>Price</h4>
                                        </div>
                                        <div class="col-md-2">
                                            <h4>Remove</h4>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="cart-item">
                                <div class="row">
                                    <div class="col-md-6 my-auto">
                                        <a href="{{ url('collections/' . $item->product->category->slug . '/' . $item->product->slug) }}">
                                            <img src="{{ $item->product->productImages[0]->image ?? 'default-image.jpg' }}"
                                                style="width: 50px; height: 50px" alt="{{ $item->product->name }}">
                                            {{ $item->product->name }}
                                        </a>
                                    </div>
                                    <div class="col-md-2 my-auto">
                                        Rp {{ number_format($item->product->selling_price, 2) }}
                                    </div>
                                    <div class="col-md-2 col-5 my-auto">
                                        <form action="{{ route('wishlist.remove', $item->product->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i> Remove
                                            </button>
                                        </form>
                                        <form action="{{ route('cart.add', $item->product->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Add to Cart</button>
                                        </form>   
                                    </div>
                                </div>
                            </div>
                        @empty
                            <h4>No Wishlist Items. Go shopping.</h4>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
