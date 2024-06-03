@extends('layout.admin')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Add Category 
                    <a href="{{ url('admin/category') }}" class="btn btn-primary text-white float-end">Back</a>
                </h3>
            </div>
            <div class="card-body">
                @if($errors->any())
                <div class="alert alert-warning">
                    @foreach ($errors->all() as $error)
                        <div class="">{{ $error }}</div>
                    @endforeach
                </div>
                @endif
                <form action="{{ url('admin/category') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name">Name <small>*</small></label>
                            <input type="text" name="name" class="form-control">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="slug">Slug <small>*</small></label>
                            <input type="text" name="slug" class="form-control">
                            @error('slug')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="description">Description <small>*</small></label>
                            <br>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                            @error('description')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="image">Image <small>*</small></label>
                            <input type="file" name="image" class="form-control">
                            @error('image')
                            <small class="text-danger"> {{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-5 mt-4">
                            <input type="checkbox" name="status">
                            <label for="status">Status</label>
                        </div>
                        <div class="col-md-12">
                            <h4>SEO Tags</h4>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="meta_title">Meta Title</label>
                            <input type="text" name="meta_title" class="form-control">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="meta_keyword">Meta Keyword</label>
                            <br>
                            <textarea name="meta_keyword" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="meta_description">Meta Description</label>
                            <br>
                            <textarea name="meta_description" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="col-md-12 mb-3 text-danger">
                            * Required
                        </div>
                        <div class="col-md-12 mb-3">
                            <button class="btn btn-primary float-end" type="submit">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

@endsection