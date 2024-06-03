@extends('layout.app')

@section('title', 'BetelShop')

@section('content')

    <div class="py-5 bg-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <h4>Welcome to Betelnut Shop.</h4>
                    <div class="underline mx-auto"></div>
                    <p>
                        Our commitment extends beyond providing exceptional products. We strive to offer outstanding
                        customer service, ensuring your shopping experience is seamless and satisfying. From prompt
                        deliveries to responsive support, we're here to exceed your expectations.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h4>New Arrival</h4>
                    <div class="underline mb-5"></div>
                </div>
                <div class="col-md-4 text-end">
                    <a class="btn btn-warning" href="{{ url('newArrivals') }}">View More</a>
                </div>
                @if ($newArrivalProducts)
                    <div class="col-md-12">
                        <div class="owl-carousel owl-theme four-carousel">
                            @foreach ($newArrivalProducts as $productItem)
                                <div class="item">
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
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="col-md-12">
                        <div class="p-2">
                            <h4>
                                No New Arrival Products Availablie
                            </h4>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="py-5 bg-white mt-5 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>Trending Products</h4>
                    <div class="underline mb-5"></div>
                </div>
                @if ($trendingProducts)
                <div class="col-md-12">
                    <div class="owl-carousel owl-theme four-carousel">
                        @foreach ($trendingProducts as $productItem)
                            <div class="item">
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
                        @endforeach
                    </div>
                </div>
            @else
                <div class="col-md-12">
                    <div class="p-2">
                        <h4>
                            No Trending Product Available
                        </h4>
                    </div>
                </div>
            @endif
            </div>
        </div>
    </div>
    <div class="py-5 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h4>Featured Products</h4>
                    <div class="underline mb-5"></div>
                </div>
                <div class="col-md-4 text-end">
                    <a class="btn btn-warning" href="{{ url('featured-product') }}">View More</a>
                </div>
                @if ($featuredProduct)
                    <div class="col-md-12">
                        <div class="owl-carousel owl-theme four-carousel">
                            @foreach ($featuredProduct as $productItem)
                                <div class="item">
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
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="col-md-12">
                        <div class="p-2">
                            <h4>
                                No Featured Products Availablie
                            </h4>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $('.four-carousel').owlCarousel({
            loop: true,
            margin: 10,
            dot:true,
            nav: false,
            autoplay:true,
            autoplayTimeout:3000,
            autoplayHoverPause:true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 4
                }
            }
        })
    </script>
@endpush