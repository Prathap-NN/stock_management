@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Product List</h2>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Add Product</a>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>SKU</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->sku }}</td>
                <td>{{ $product->quantity }}</td>
                <td>{{ $product->price }}</td>
                <td>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this product?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
