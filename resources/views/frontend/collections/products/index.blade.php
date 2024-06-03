@extends('layout.app')

@section('title')
{{ $category->meta_title }}
@endsection

@section('meta_keyword')
{{ $category->meta_keyword }}
@endsection

@section('meta_description')
{{ $category->meta_description }}
@endsection

@section('content') 


<div class="py-3 py-md-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="mb-4"> Category: {{ $category->name }}</h4>
                <h4 class="mb-4">Our Products</h4>
            </div>
            <div>
                <div class="row">
                    <div class="col-md-9">
                        <div class="row">
                            @forelse ($products as $productItem)
                                <div class="col-md-4">
                                    <div class="product-card">
                                        <div class="product-card-img">
                                            <a href="{{ url('/collections/'.$productItem->category->slug.'/'.$productItem->slug) }}">
                                            @if ($productItem->quantity > 0)
                                                <label class="stock bg-success">In Stock</label>      
                                            @else
                                            <label class="stock bg-danger">Out of Stock</label>                      
                                            @endif
                                            @if ($productItem->productImages->count() > 0)
                                            <img src="{{ asset($productItem->productImages[0]->image) }}" alt="{{ $productItem->name }}" style="width: 100%; height: 300px">
                                            @endif
                                            </a>
                                        </div>
                                        <div class="product-card-body">
                                            <p class="product-brand">{{ $productItem->brand}}</p>
                                            <h5 class="product-name">
                                               <a href="{{ url('/collections/'.$productItem->category->slug.'/'.$productItem->slug) }}">
                                                    {{ $productItem ->name }}
                                               </a>
                                            </h5>
                                            <div>
                                                <a href="{{ url('/collections/'.$productItem->category->slug.'/'.$productItem->slug) }}">
                                                <span class="selling-price">Rp {{ $productItem->selling_price }}</span>
                                                {{-- <span class="original-price">Rp {{ $productItem->original_price }}</span> --}}
                                                </a>
                                            </div>
                                            <div class="mt-2">
                                                <a href="" class="btn btn1">Add To Cart</a>
                                                <a href="{{ url('/collections/'.$productItem->category->slug.'/'.$productItem->slug) }}" class="btn btn1"> View </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <div class="col-md-12">
                                    <div class="p-2">
                                        <h4>
                                            No Available Products for {{ $category->name }}
                                        </h4>
                                    </div>
                                </div>
                                    
                                @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection