@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>{{ $toy->name }}</h1>
            <img src="{{ asset('storage/' . $toy->image) }}" width="200" height="200">
            <p>{{ $toy->description }}</p>
            <p>Stock: {{ $toy->stock }}</p>
            <p>Category: {{ $toy->category->name }}</p>
            <a href="{{ route('toys.index') }}" class="btn btn-primary">Back</a>
        </div>
    </div>
</div>
@endsection
