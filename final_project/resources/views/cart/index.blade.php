@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Shopping Cart</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(empty($cart) || count($cart) === 0)
        <p>Your cart is empty.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0 @endphp
                @foreach($cart as $id => $details)
                @php $subtotal = $details['price'] * $details['quantity'] @endphp
                @php $total += $subtotal @endphp
                <tr>
                    <td><img src="{{ $details['image'] }}" width="100" alt="{{ $details['name'] }}"></td>
                    <td>{{ $details['name'] }}</td>
                    <td>{{ $details['quantity'] }}</td>
                    <td>${{ $details['price'] }}</td>
                    <td>${{ $subtotal }}</td>
                    <td>
                        <form action="{{ route('cart.remove', $id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Remove</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-right">
            <h3>Total: ${{ $total }}</h3>
        </div>
        <form action="{{ route('cart.buy') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Buy Items</button>
        </form>
    @endif
</div>
@endsection
