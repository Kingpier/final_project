@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $toy->name }}</h1>
    <div class="row">
        <div class="col-md-6">
            <img src="{{ $toy->image }}" class="img-fluid" alt="{{ $toy->name }}">
        </div>
        <div class="col-md-6">
            <p>{{ $toy->description }}</p>
            <p>Price: ${{ $toy->price }}</p>
            <p>Stock: {{ $toy->stock }}</p>
            <form action="{{ route('cart.add', $toy->toy_id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Add to Cart</button>
            </form>
        </div>
    </div>
</div>
@endsection
