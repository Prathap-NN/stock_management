@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Product</h2>

    <form action="{{ route('products.update', $product) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label class="form-label">Product Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">SKU</label>
            <input type="text" name="sku" class="form-control" value="{{ old('sku', $product->sku) }}" required>
            @error('sku') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Quantity</label>
            <input type="number" name="quantity" class="form-control" value="{{ old('quantity', $product->quantity) }}" required>
            @error('quantity') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Price</label>
            <input type="text" name="price" class="form-control" value="{{ old('price', $product->price) }}" required>
            @error('price') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Product</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
