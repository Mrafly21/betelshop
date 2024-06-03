@extends('layout.admin')

@section('title', 'Product Category')

@section('content')
<div>
    <div>
        <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Category Delete</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form wire:submit.prevent="destroyCategory">
                        <div class="modal-body">
                            <h6>Are you sure want to delete this category?</h6>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Yes. Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">

            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h3>
                        Category
                        <a href="{{ url('admin/category/create') }}" class="btn btn-primary float-end">Add Category</a>
                    </h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->status == '1' ? 'Hidden' : 'Visible' }}</td>
                                        <td>
                                            <a class="btn btn-success my-2"
                                                href="{{ url('admin/category/' . $category->id . '/edit') }}">Edit</a>
                                            <a class="btn btn-danger" href="#" data-bs-toggle="modal" data-bs-dismiss="modal"
                                                data-bs-target="#deleteModal" wire:click="deleteCategory({{ $category->id }})">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div>
                        {{-- {{ $categories->links() }} --}}
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


@endsection