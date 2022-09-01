@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('admin.posts.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Post Title</label>
                <input type="text" class="form-control" name="title" id="title" placeholder="Title">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Post Text.....</label>
                <textarea class="form-control" name="description" id="description" rows="3" placeholder="Description"></textarea>
            </div>

            <div class="mb-3">
                <label for="thumb" class="form-label">Post Image</label>
                <input type="file" class="form-control" name="image" id="image" placeholder="image">
            </div>

            <div class="d-flex g-2">
                <button type="submit" class="btn btn-success mx-2">Add</button>
                <button type="reset" class="btn btn-secondary mx-2">Clear</button>

                <a href="{{ route('admin.posts.index') }}" class="btn btn-danger mx-2">Home</a>
            </div>
        </form>

    </div>
@endsection
