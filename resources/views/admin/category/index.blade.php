@extends('layout.admin')

@section('title', 'Product Category')

@section('content')

<div>
    <div>
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Category Delete</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form>
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
                                    <tr>
                                        <td>1</td>
                                        <td>Dried</td>
                                        <td>Visible</td>
                                        <td>
                                            <a class="btn btn-success my-2"
                                                href="{{ url('admin/category/edit') }}">Edit</a>
                                            <a class="btn btn-danger" href="#" data-bs-toggle="modal" data-bs-dismiss="modal"
                                                data-bs-target="#deleteModal"">Delete</a>
                                        </td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                    {{-- <div>
                        {{ $categories->links() }}
                    </div> --}}
                </div>
            </div>

        </div>
    </div>
</div>

@endsection