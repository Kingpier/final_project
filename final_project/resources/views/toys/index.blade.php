@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Our Toys</h1>
    <form action="{{ route('search') }}" method="GET">
        <input type="text" name="query" placeholder="Search toys...">
        <button type="submit">Search</button>
    </form>
    <form action="{{ route('filter') }}" method="GET">
        <select name="category_id">
            <option value="">All Categories</option>
            @foreach($categories as $category)
                <option value="{{ $category->category_id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        <button type="submit">Filter</button>
    </form>
    <div class="row mt-4">
        @foreach($toys as $toy)
        <div class="col-md-4">
            <div class="card mb-4">
                <img src="{{ asset($toy->image) }}" class="card-img-top" alt="{{ $toy->name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $toy->name }}</h5>
                    <p class="card-text">{{ $toy->description }}</p>
                    <p class="card-text">Price: ${{ $toy->price }}</p>
                    <p class="card-text">Stock: {{ $toy->stock }}</p>
                    <a href="{{ route('toys.show', $toy->toy_id) }}" class="btn btn-primary">View Details</a>
                    <form action="{{ route('cart.add', $toy->toy_id) }}" method="POST" style="margin-top: 10px;">
                        @csrf
                        <button type="submit" class="btn btn-success">Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
