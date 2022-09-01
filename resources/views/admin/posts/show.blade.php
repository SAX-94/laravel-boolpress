@extends('layouts.app')

@section('content')
 <div class="container">
    <div class="post shadow h-100">
        <img src="{{ asset('/storage/' . $post['image']) }}" class="img-fluid" alt="">
        <div class="p-3 mb-3">
            <div class="title">
                {{ $post['title'] }}
            </div>
            <div class="description">
                {{ $post['description'] }}
            </div>
            <div class="row">
                <div class="col-6">
                    {{ $post['created_at'] }}
                </div>
            </div>
        </div>
    </div>
 </div>
@endsection