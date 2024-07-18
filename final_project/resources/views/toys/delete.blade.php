@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h1>Delete Toy</h1>
            <form action="{{ route('toys.destroy', $toy->toy_id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ $toy->name }}" disabled>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" id="description" disabled>{{ $toy->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="stock">Stock</label>
                    <input type="number" name="stock" class="form-control" id="stock" value="{{ $toy->stock }}" disabled>
                </div>
                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select name="category_id" class="form-control" id="category_id" disabled>
                        @foreach($categories as $category)
                            <option value="{{ $category->category_id }}" {{ $category->category_id == $toy->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <img src="{{ asset('storage/' . $toy->image) }}" width="100" height="100">
                </div>
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection
