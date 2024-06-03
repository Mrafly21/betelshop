@extends('layout.admin')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Edit Category 
                    <a href="{{ url('admin/category') }}" class="btn btn-primary text-white float-end">Back</a>
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/category/'.$category->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name">Name <small>*</small></label>
                            <input type="text" name="name" class="form-control" value="{{ $category->name }}">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="slug">Slug <small>*</small></label>
                            <input type="text" name="slug" class="form-control"  value="{{ $category->slug }}">
                            @error('slug')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="description">Description <small>*</small></label>
                            <br>
                            <textarea name="description" class="form-control" rows="3">{{ $category->description }}</textarea>
                            @error('description')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="image">Image <small>*</small></label>
                            <input type="file" name="image" class="form-control">
                            <img src="{{ asset('/uploads/category/'.$category->image) }}" width="60px" height="60px" class="mt-3" alt="">
                            @error('image')
                            <small class="text-danger"> {{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-5 mt-4">
                            <input type="checkbox" name="status" {{ $category -> status == '1' ? 'checked' : '' }}>
                            <label for="status">Status</label>
                        </div>
                        <div class="col-md-12">
                            <h4>SEO Tags</h4>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="meta_title">Meta Title</label>
                            <input type="text" name="meta_title" class="form-control"  value="{{ $category->meta_title }}">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="meta_keyword">Meta Keyword</label>
                            <br>
                            <textarea name="meta_keyword" class="form-control" rows="3">{{ $category->meta_keyword }}</textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="meta_description">Meta Description</label>
                            <br>
                            <textarea name="meta_description" class="form-control" rows="3">{{ $category->meta_description }}</textarea>
                        </div>
                        <div class="col-md-12 mb-3 text-danger">
                            * Required
                        </div>
                        <div class="col-md-12 mb-3">
                            <button class="btn btn-primary float-end" type="submit">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

@endsection