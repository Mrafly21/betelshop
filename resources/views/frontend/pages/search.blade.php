@extends('layout.app')

@section('title', 'Search Result')

@section('content')
    <div class="py-5 bg-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <h4>Product Search Result</h4>
                    <div class="underline mb-5"></div>
                </div>
                @forelse ($searchProduct as $productItem)
                    <div class="col-md-10">
                        <div class="product-card p-3">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="product-card-img">
                                        <a
                                            href="{{ url('/collections/' . $productItem->category->slug . '/' . $productItem->slug) }}">

                                            <label class="stock bg-danger">New</label>

                                            @if ($productItem->productImages->count() > 0)
                                                <img src="{{ asset($productItem->productImages[0]->image) }}"
                                                    alt="{{ $productItem->name }}" style="width: 100%; height: 200px">
                                            @endif
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-9">
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
                                        <p style="height:45px;overvlow:hidden">
                                            <b>Description: </b> {{ $productItem->description }}
                                        </p>
                                       
                                            <a href="{{ url('/collections/' . $productItem->category->slug . '/' . $productItem->slug) }}"
                                                class="btn btn-outline-primary"> View </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-md-3">
                        <div class="product-card">
                            
                           
                        </div>
                    </div> --}}
                @empty
                    <div class="col-md-12">
                        <div class="p-2">
                            <h4>
                                No products with that keywords.
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
