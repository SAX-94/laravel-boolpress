@extends('layouts.app')

@section('content')
    <form action="{{ route('admin.posts.update' , $post->id) }}" method="post">
        @csrf

        @method('PATCH')

        <div class="mb-3">
            <label for="title" class="form-label">Post Title</label>
            <input type="text" class="form-control" name="title" id="title"  value="{{$post["title"]}}" >
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Post Description</label>
            <textarea class="form-control" name="description" id="description" rows="3"  >{{$post["description"]}}</textarea>
        </div>

        <div class="mb-3">
            <label for="thumb" class="form-label">Post Image link</label>
            <input type="text" class="form-control" name="image" id="image" value="{{$post["image"]}}" >
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success">Update</button>
            <button type="reset" class="btn btn-secondary">Clear</button>
            
            <a href="{{ route('admin.posts.index') }}" class="btn btn-danger">Home</a>
        </div>
    </form>
@endsection