@extends('layout.app')

@section('title')
    {{ $product->meta_title }}
@endsection

@section('content')
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
                            <img src="{{ asset($product->productImages[0]->image) }}" class="w-100" alt="Image of {{ $product->name }}">
                        @else
                            <h4>No Image Added</h4>
                        @endif
                    </div>
                </div>
                <div class="col-md-7 mt-3">
                    <div class="product-view">
                        <h4 class="product-name">{{ $product->name }}</h4>
                        <hr>
                        <p class="product-path">
                            Home / {{ $product->category->name }} / {{ $product->name }}
                        </p>
                        <div>
                            <span class="selling-price">Rp {{ $product->selling_price }}</span>
                            <span class="original-price">Rp {{ $product->original_price }}</span>
                        </div>
                        <div class="mt-2">
                            <label class="{{ $product->quantity > 0 ? 'bg-success' : 'bg-danger' }} btn-sm py-1 mt-2 text-white">{{ $product->quantity > 0 ? 'In stock' : 'Out of Stock' }}</label>
                        </div>
                        <div class="mt-2">
                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                @csrf
                                <div class="input-group mb-3">
                                    <button class="btn btn-outline-secondary" type="button" onclick="decrementValue()">-</button>
                                    <input type="text" name="quantity" id="quantityInput" class="form-control text-center" value="1" min="1" max="{{ $product->quantity }}">
                                    <button class="btn btn-outline-secondary" type="button" onclick="incrementValue({{ $product->quantity }})">+</button>
                                </div>
                                <button type="submit" class="btn btn-primary">Add to Cart</button>
                            </form>                          
                            
                            <form action="{{ route('wishlist.add', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-secondary">Add to Wishlist</button>
                            </form>
                        </div>
                        <div class="mt-3">
                            <h5 class="mb-0">Small Description</h5>
                            <p>{{ $product->small_description }}</p>
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
                            <p>{{ $product->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
<script>
    console.log("incrementValue called.");
</script>
<script>
   
function incrementValue(maxQuantity) {
    var quantityInput = document.getElementById('quantityInput');
    var currentValue = parseInt(quantityInput.value, 10);
    if (currentValue < maxQuantity) {
        quantityInput.value = currentValue + 1;
    }
}

function decrementValue() {
    var quantityInput = document.getElementById('quantityInput');
    var currentValue = parseInt(quantityInput.value, 10);
    if (currentValue > 1) {
        quantityInput.value = currentValue - 1;
    }
}
</script>
@endpush
