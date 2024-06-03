@extends('layout.app')

@section('title')
    {{ $product->meta_title }}
@endsection

@section('meta_keyword')
    {{ $product->meta_keyword }}
@endsection

@section('meta_description')
    {{ $product->meta_description }}
@endsection

@section('content')
    <div>
        <div class="py-3 py-md-5 bg-light">
            <div class="container">
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-5 mt-3">
                        <div class="bg-white border">
                            @if ($product->productImages)
                                <img src="{{ asset($product->productImages[0]->image) }}" class="w-100" alt="Img">
                            @else
                                <h4>No Image Added</h4>
                            @endif

                        </div>
                    </div>
                    <div class="col-md-7 mt-3">
                        <div class="product-view">
                            <h4 class="product-name">
                                {{ $product->name }}
                            </h4>
                            <hr>
                            <p class="product-path">
                                Home / {{ $product->category->name }} / {{ $product->name }}
                            </p>
                            <div>
                                <span class="selling-price">Rp {{ $product->selling_price }}</span>
                                <span class="original-price">Rp {{ $product->original_price }}</span>
                            </div>
                            <div class="mt-2">
                                @if ($product->count() > 0)
                                    @if ($product->quantity)
                                        <label class="btn-sm bg-success py-1 mt-2 text-white">In stock</label>
                                    @else
                                        <label class="btn-sm bg-danger py-1 mt-2 text-white">Out of Stock</label>
                                    @endif
                                @endif
                            </div>
                            {{-- <div class="mt-2">
                                <div class="input-group">
                                    <span class="btn btn1" wire:click="decrementQuantity"><i class="fa fa-minus"></i></span>
                                    <input type="text" value="{{ $this->quantityCount }}" class="input-quantity" />
                                    <span class="btn btn1" wire:click="incrementQuantity"><i class="fa fa-plus"></i></span>
                                </div>
                                @if (session('warning'))
                                    <div class="alert alert-danger mt-2">{{ session('warning') }}</div>
                                @endif
                            </div> --}}
                            <div class="mt-2">
                                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                                </form>
                                
                                <form action="{{ route('wishlist.add', $product->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-secondary">Add to Wishlist</button>
                                </form>

                            </div>
                            <div class="mt-3">
                                <h5 class="mb-0">Small Description</h5>
                                <p>
                                    {{ $product->small_description }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mt-3">
                        <div class="card">
                            <div class="card-header bg-white">
                                <h4>Description</h4>
                            </div>
                            <div class="card-body">
                                <p>
                                    {{ $product->description }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
