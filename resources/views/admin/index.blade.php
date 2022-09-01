@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-5 mr-4 text-center bg-danger">
                <div class="p-3">
                    <h2 class="mb-4">Posts</h2>
                    <div class="mb-1">
                        <a href="{{route('admin.posts.index')}}" class="btn">Admin</a>
                    </div>
                </div>
            </div>
            <div class="col-5 ml-4 text-center bg-danger">
                <div class="p-3">
                    <h2 class="mb-4">Details</h2>
                    <div class="mb-1">
                        <a href="{{route('admin.users.index')}}" class="btn">Users</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
