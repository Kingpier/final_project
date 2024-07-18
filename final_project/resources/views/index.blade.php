@extends('layouts.app')

@section('content')
<div class="container">
    <div class="jumbotron">
        <h1 class="display-4">Welcome to Toy Store!</h1>
        <p class="lead">Find the best toys for your kids here.</p>
        <hr class="my-4">
        <p>Explore our wide range of toys and enjoy shopping.</p>
        <a class="btn btn-primary btn-lg" href="{{ url('/toys') }}" role="button">Shop Now</a>
    </div>
</div>
@endsection
