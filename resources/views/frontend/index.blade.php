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
                <div class="col-md-12">
                    <div class="p-2">
                        <h4>
                            No New Arrival Products Availablie Yet
                        </h4>
                    </div>
                </div>
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
                <div class="col-md-3">
                    <div class="">
                        <div class="item">
                            <div class="product-card">
                                <div class="product-card-img">
                                    <a href="{{ url('/collections/product-item') }}">

                                        <label class="stock bg-danger">New</label>
                                        <img src="{{ asset('upload/products/betelnut-sample.jpg') }}" alt="Betel Nut"
                                            style="width: 100%; height: 300px">
                                    </a>
                                </div>
                                <div class="product-card-body">
                                    <h5 class="product-name">
                                        <a href="{{ url('/collections/product-item') }}">
                                            Betel Nut Dried
                                        </a>
                                    </h5>
                                    <div>
                                        <a href="{{ url('/collections/product-item') }}">
                                            <span class="selling-price">Rp 2.000.000</span>
                                            {{-- <span class="original-price">Rp
                                                        {{ $productItem->original_price }}</span> --}}
                                        </a>
                                    </div>
                                    <div class="mt-2">
                                        <a href="" class="btn btn1">Add To Cart</a>
                                        <a href="{{ url('/collections/') }}" class="btn btn1"> View </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="">
                        <div class="item">
                            <div class="product-card">
                                <div class="product-card-img">
                                    <a href="{{ url('/collections/product-item') }}">

                                        <label class="stock bg-danger">New</label>
                                        <img src="{{ asset('upload/products/betelnut-sample.jpg') }}" alt="Betel Nut"
                                            style="width: 100%; height: 300px">
                                    </a>
                                </div>
                                <div class="product-card-body">
                                    <h5 class="product-name">
                                        <a href="{{ url('/collections/product-item') }}">
                                            Betel Nut Dried
                                        </a>
                                    </h5>
                                    <div>
                                        <a href="{{ url('/collections/product-item') }}">
                                            <span class="selling-price">Rp 2.000.000</span>
                                            {{-- <span class="original-price">Rp
                                                        {{ $productItem->original_price }}</span> --}}
                                        </a>
                                    </div>
                                    <div class="mt-2">
                                        <a href="" class="btn btn1">Add To Cart</a>
                                        <a href="{{ url('/collections/') }}" class="btn btn1"> View </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="">
                        <div class="item">
                            <div class="product-card">
                                <div class="product-card-img">
                                    <a href="{{ url('/collections/product-item') }}">

                                        <label class="stock bg-danger">New</label>
                                        <img src="{{ asset('upload/products/betelnut-sample.jpg') }}" alt="Betel Nut"
                                            style="width: 100%; height: 300px">
                                    </a>
                                </div>
                                <div class="product-card-body">
                                    <h5 class="product-name">
                                        <a href="{{ url('/collections/product-item') }}">
                                            Betel Nut Dried
                                        </a>
                                    </h5>
                                    <div>
                                        <a href="{{ url('/collections/product-item') }}">
                                            <span class="selling-price">Rp 2.000.000</span>
                                            {{-- <span class="original-price">Rp
                                                        {{ $productItem->original_price }}</span> --}}
                                        </a>
                                    </div>
                                    <div class="mt-2">
                                        <a href="" class="btn btn1">Add To Cart</a>
                                        <a href="{{ url('/collections/') }}" class="btn btn1"> View </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="">
                        <div class="item">
                            <div class="product-card">
                                <div class="product-card-img">
                                    <a href="{{ url('/collections/product-item') }}">

                                        <label class="stock bg-danger">New</label>
                                        <img src="{{ asset('upload/products/betelnut-sample.jpg') }}" alt="Betel Nut"
                                            style="width: 100%; height: 300px">
                                    </a>
                                </div>
                                <div class="product-card-body">
                                    <h5 class="product-name">
                                        <a href="{{ url('/collections/product-item') }}">
                                            Betel Nut Dried
                                        </a>
                                    </h5>
                                    <div>
                                        <a href="{{ url('/collections/product-item') }}">
                                            <span class="selling-price">Rp 2.000.000</span>
                                            {{-- <span class="original-price">Rp
                                                        {{ $productItem->original_price }}</span> --}}
                                        </a>
                                    </div>
                                    <div class="mt-2">
                                        <a href="" class="btn btn1">Add To Cart</a>
                                        <a href="{{ url('/collections/') }}" class="btn btn1"> View </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-12">
                        <div class="p-2">
                            <h4>
                                No Available Products Availablie
                            </h4>
                        </div>
                    </div>
               --}}
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
                <div class="col-md-3">
                    <div class="">
                        <div class="item">
                            <div class="product-card">
                                <div class="product-card-img">
                                    <a href="{{ url('/collections/product-item') }}">

                                        <label class="stock bg-danger">New</label>
                                        <img src="{{ asset('upload/products/betelnut-sample.jpg') }}" alt="Betel Nut"
                                            style="width: 100%; height: 300px">
                                    </a>
                                </div>
                                <div class="product-card-body">
                                    <h5 class="product-name">
                                        <a href="{{ url('/collections/product-item') }}">
                                            Betel Nut Dried
                                        </a>
                                    </h5>
                                    <div>
                                        <a href="{{ url('/collections/product-item') }}">
                                            <span class="selling-price">Rp 2.000.000</span>
                                            {{-- <span class="original-price">Rp
                                                        {{ $productItem->original_price }}</span> --}}
                                        </a>
                                    </div>
                                    <div class="mt-2">
                                        <a href="" class="btn btn1">Add To Cart</a>
                                        <a href="{{ url('/collections/') }}" class="btn btn1"> View </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="">
                        <div class="item">
                            <div class="product-card">
                                <div class="product-card-img">
                                    <a href="{{ url('/collections/product-item') }}">

                                        <label class="stock bg-danger">New</label>
                                        <img src="{{ asset('upload/products/betelnut-sample.jpg') }}" alt="Betel Nut"
                                            style="width: 100%; height: 300px">
                                    </a>
                                </div>
                                <div class="product-card-body">
                                    <h5 class="product-name">
                                        <a href="{{ url('/collections/product-item') }}">
                                            Betel Nut Dried
                                        </a>
                                    </h5>
                                    <div>
                                        <a href="{{ url('/collections/product-item') }}">
                                            <span class="selling-price">Rp 2.000.000</span>
                                            {{-- <span class="original-price">Rp
                                                        {{ $productItem->original_price }}</span> --}}
                                        </a>
                                    </div>
                                    <div class="mt-2">
                                        <a href="" class="btn btn1">Add To Cart</a>
                                        <a href="{{ url('/collections/') }}" class="btn btn1"> View </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="p-2">
                        <h4>
                            No Featured Products Availablie
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
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
@endsection