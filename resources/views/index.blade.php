@extends('layouts.app')
@section('content')
    
    <div class="container text-center text-primary">
        <h1>BOOLPRESS</h1>
    </div>
    
    <div class="container mt-5 py-4 text-center">
        <a class="btn btn-primary btn-bool mt-5" href="{{ route('login') }}">
            Accedi
        </a>
        <a class="btn btn-primary btn-bool mt-5" href="{{ route('public') }}">
            Area Pubblica
        </a>
    </div>
    
@endsection
