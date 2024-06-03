@extends('layout.app')

@section('title', 'Featured Products')

@section('content')
<div class="py-5 bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>Featured Products</h4>
                <div class="underline mb-5"></div>
            </div>  
                @forelse ($featuredProduct as $productItem)
                <div class="col-md-3">
                    <div class="product-card">
                        <div class="product-card-img">
                            <a
                                href="{{ url('/collections/' . $productItem->category->slug . '/' . $productItem->slug) }}">

                                <label class="stock bg-danger">New</label>

                                @if ($productItem->productImages->count() > 0)
                                    <img src="{{ asset($productItem->productImages[0]->image) }}"
                                        alt="{{ $productItem->name }}" style="width: 100%; height: 300px">
                                @endif
                            </a>
                        </div>
                        <div class="product-card-body">
                            <p class="product-brand">{{ $productItem->brand }}</p>
                            <h5 class="product-name">
                                <a
                                    href="{{ url('/collections/' . $productItem->category->slug . '/' . $productItem->slug) }}">
                                    {{ $productItem->name }}
                                </a>
                            </h5>
                            <div>
                                <a
                                    href="{{ url('/collections/' . $productItem->category->slug . '/' . $productItem->slug) }}">
                                    <span class="selling-price">Rp {{ $productItem->selling_price }}</span>
                                    {{-- <span class="original-price">Rp
                                        {{ $productItem->original_price }}</span> --}}
                                </a>
                            </div>
                            <div class="mt-2">
                                <a href="" class="btn btn1">Add To Cart</a>
                                <a href="{{ url('/collections/' . $productItem->category->slug . '/' . $productItem->slug) }}"
                                    class="btn btn1"> View </a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                    <div class="col-md-12">
                        <div class="p-2">
                            <h4>
                                No Available Products Available
                            </h4>
                        </div>
                    </div>
                @endforelse    

                <div class="col-md-12">
                    <div class="text-center">
                        <a class="btn btn-warning" href="{{ url('collections') }}">View More</a>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection