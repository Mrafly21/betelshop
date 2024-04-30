@extends('layout.admin')

@section('title', 'Product List')

@section('content')
    <div class="row">

        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Products
                        <div class="row my-2">
                            <div class="col-6">
                                <a href="{{ url('/') }}" class="btn btn-dark text-white">View User Page</a>
                            </div>
                            <div class="col-6">
                                <a href="{{ url('admin/products/create') }}" class="btn btn-primary text-white">Add
                                    Product</a>
                            </div>
                        </div>
                    </h3>  
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-bordered table striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>
                                       Dried
                                    </td>
                                    <td>Betel Nut Dried</td>
                                    <td>Rp. 3.000.000</td>
                                    <td>5</td>
                                    <td>Visible</td>
                                    <td>
                                        <a class="btn btn-sm btn-success my-2"
                                            href="{{ url('admin/products/edit') }}">Edit</a>
                                        <a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure want to delete this product?')" href="{{ url('admin/products/delete') }}" >Delete</a>
                                    </td>
                                </tr>
                            {{-- @empty
                                <td colspan="7">No Product Available</td>
                            @endforelse --}}
                        </tbody>
                    </table>
                    </div>
                    <div>
                        {{-- {{ $product->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
